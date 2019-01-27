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

var Map = require('../../../src/collections/Map');

// Finite numbers hash to their absolute value; everything else hashes to zero.
var hash = function(x) {
  return typeof x === 'number' && isFinite(x) ? Math.floor(Math.abs(x)) : 0;
};

suite('Map', function() {

  suite('get', function() {

    test('existing key', function() {
      var map = new Map(deepEqual, hash);
      assert.isNull(map.set(42, 'abc'));
      assert.strictEqual(map.get(42), 'abc');
    });

    test('nonexisting key', function() {
      var map = new Map(deepEqual, hash);
      assert.isNull(map.get(42));
    });

    test('nonexisting key with same hash as existing key', function() {
      var map = new Map(deepEqual, hash);
      assert.isNull(map.set({}, 'abc'));
      assert.isNull(map.get(""));
    });

  });

  suite('set', function() {

    test('nonexisting key', function() {
      var map = new Map(deepEqual, hash);
      assert.isNull(map.set(42, 'abc'));
      assert.isTrue(map.has(42));
    });

    test('key with same hash as existing key', function() {
      var map = new Map(deepEqual, hash);
      assert.isNull(map.set({}, 'abc'));
      assert.isNull(map.set("", 'xyz'));
      assert.isTrue(map.has({}));
      assert.isTrue(map.has(""));
    });

    test('existing key', function() {
      var map = new Map(deepEqual, hash);
      assert.isNull(map.set(42, 'abc'));
      assert.strictEqual(map.set(42, 'xyz'), 'abc');
      assert.isTrue(map.has(42));
      assert.strictEqual(map.get(42), 'xyz');
    });

  });

  suite('del', function() {

    test('existing key', function() {
      var map = new Map(deepEqual, hash);
      var elem = {};
      assert.isNull(map.set(elem, 'abc'));
      assert.strictEqual(map.del({}), 'abc');
      assert.isFalse(map.has(elem));
    });

    test('nonexisting key', function() {
      var map = new Map(deepEqual, hash);
      map.set(42, 'abc');
      assert.isNull(map.del(37));
    });

    test('existing key with same hash as existing key', function() {
      var map = new Map(deepEqual, hash);
      map.set({}, 'abc');
      map.set("", 'xyz');
      assert.strictEqual(map.del(""), 'xyz');
      assert.isFalse(map.has(""));
      assert.isTrue(map.has({}));
      assert.strictEqual(map.get({}), 'abc');
    });

    test('nonexisting key with same hash as existing key', function() {
      var map = new Map(deepEqual, hash);
      map.set({}, 'abc');
      assert.isNull(map.del(""));
      assert.isTrue(map.has({}));
      assert.strictEqual(map.get({}), 'abc');
    });

  });

  suite('size', function() {

    test('empty', function() {
      var map = new Map(deepEqual, hash);
      assert.strictEqual(map.size(), 0);
    });

    test('single element', function() {
      var map = new Map(deepEqual, hash);
      map.set(42, 'abc');
      assert.strictEqual(map.size(), 1);
    });

    test('more elements than buckets', function() {
      var map = new Map(deepEqual, hash, 16);
      for (var i = 0; i < 32; i++) {
        map.set(i, 2*i);
      }
      assert.strictEqual(map.size(), 32);
    });

  });

  suite('clear', function() {

    test('clear', function() {
      var map = new Map(deepEqual, hash);
      for (var i = 0; i < 10; i++) {
        map.set(i, 2*i);
      }
      map.clear();
      assert.strictEqual(map.size(), 0);
    });

  });

  suite('each', function() {

    test('each', function() {
      var map = new Map(deepEqual, hash);
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
