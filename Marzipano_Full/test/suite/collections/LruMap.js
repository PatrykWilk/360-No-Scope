/*
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
'use strict';

var assert = require('chai').assert;

var deepEqual = require('deep-equal');

var LruMap = require('../../../src/collections/LruMap');

// Finite numbers hash to their absolute value; everything else hashes to zero.
var hash = function(x) {
  return typeof x === 'number' && isFinite(x) ? Math.floor(Math.abs(x)) : 0;
};

suite('LruMap', function() {

  suite('get', function() {

    test('existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.isNull(map.set(42, 'abc'));
      assert.strictEqual(map.get(42), 'abc');
    });

    test('nonexisting key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.isNull(map.get(42));
    });

    test('nonexisting key with same hash as existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.isNull(map.set({}, 'abc'));
      assert.isNull(map.get(""));
    });

  });

  suite('set', function() {

    test('nonexisting key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.isNull(map.set(42, 'abc'));
      assert(map.has(42));
    });

    test('key with same hash as existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.isNull(map.set({}, 'abc'));
      assert.isNull(map.set("", 'xyz'));
      assert.isTrue(map.has({}));
      assert.isTrue(map.has(""));
    });

    test('existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.isNull(map.set(42, 'abc'));
      assert.isNull(map.set(42, 'xyz'));
      assert.isTrue(map.has(42));
      assert.strictEqual(map.get(42), 'xyz');
    });

    test('existing key at full size', function() {
      var map = new LruMap(deepEqual, hash, 16);
      var oldest;
      for (var i = 0; i < 16; i++) {
        var obj = { prop: i };
        if (i === 0) {
          oldest = obj;
        }
        assert.isNull(map.set(obj, i));
      }
      assert.isNull(map.set({ prop: 0 }, 0));
      assert.isTrue(map.has(oldest));
      assert.strictEqual(map.size(), 16);
    });

    test('nonexisting key at full size', function() {
      var map = new LruMap(deepEqual, hash, 16);
      var oldest;
      for (var i = 0; i < 16; i++) {
        var obj = { prop: i };
        if (i === 0) {
          oldest = obj;
        }
        assert.isNull(map.set(obj, i));
      }
      assert.strictEqual(map.set({ prop: 42 }, 42), oldest);
      assert.isTrue(map.has({ prop: 42 }));
      assert.isFalse(map.has(oldest));
      assert.strictEqual(map.size(), 16);
    });

    test('on a set with zero maximum size', function() {
      var map = new LruMap(deepEqual, hash, 0);
      assert.strictEqual(map.set(42, 'abc'), 42);
      assert.isFalse(map.has(42));
    });

  });

  suite('del', function() {

    test('existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      var elem = {};
      assert.isNull(map.set(elem, 'abc'));
      assert.strictEqual(map.del({}), 'abc');
      assert.isFalse(map.has(elem));
    });

    test('nonexisting key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      map.set(42, 'abc');
      assert.isNull(map.del(37));
    });

    test('existing key with same hash as existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      map.set({}, 'abc');
      map.set("", 'xyz');
      assert.strictEqual(map.del(""), 'xyz');
      assert.isFalse(map.has(""));
      assert.isTrue(map.has({}));
      assert.strictEqual(map.get({}), 'abc');
    });

    test('nonexisting key with same hash as existing key', function() {
      var map = new LruMap(deepEqual, hash, 16);
      map.set({}, 'abc');
      assert.isNull(map.del(""));
      assert.isTrue(map.has({}));
      assert.strictEqual(map.get({}), 'abc');
    });

    test('first element on a full map', function() {
      var map = new LruMap(deepEqual, hash, 16);
      for (var i = 0; i < 16; i++) {
        map.set(i, i);
      }
      assert.strictEqual(map.del(0), 0);
      assert.isFalse(map.has(0));
    });

  });

  suite('size', function() {

    test('empty', function() {
      var map = new LruMap(deepEqual, hash, 16);
      assert.strictEqual(map.size(), 0);
    });

    test('single element', function() {
      var map = new LruMap(deepEqual, hash, 16);
      map.set(42, 'abc');
      assert.strictEqual(map.size(), 1);
    });

    test('full', function() {
      var map = new LruMap(deepEqual, hash, 16);
      for (var i = 0; i < 16; i++) {
        map.set(i, '' + i);
      }
      assert.strictEqual(map.size(), 16);
    });

  });

  suite('clear', function() {

    test('clear', function() {
      var map = new LruMap(deepEqual, hash, 16);
      for (var i = 0; i < 10; i++) {
        map.set(i, 2*i);
      }
      map.clear();
      assert.strictEqual(map.size(), 0);
    });

  });

  suite('each', function() {

    test('each', function() {
      var map = new LruMap(deepEqual, hash, 16);
      for (var i = 0; i < 10; i++) {
        map.set(i, 2*i);
      }

      var seen = {};
      var count = map.each(function(key, val) {
        seen[key] = val;
      });

      assert.strictEqual(count, 10);

      for (var i = 0; i < 10; i++) {
        assert.propertyVal(seen, i, 2*i);
      }
    });

  });

});
