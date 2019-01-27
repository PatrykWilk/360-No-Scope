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

var eventEmitter = require('minimal-event-emitter');
var clearOwnProperties = require('../util/clearOwnProperties');

/**
 * @class DynamicCanvasAsset
 * @implements Asset
 * @classdesc
 *
 * Dynamic asset containing an HTML canvas element.
 *
 * Call {@link DynamicCanvasAsset#changed} to notify that the contents of the
 * canvas were modified and derived textures need to be refreshed.
 *
 * @param {Element} element
 */
function DynamicCanvasAsset(element, opts) {
  opts = opts || {};

  this._opts = opts;

  this._element = element;
  this._timestamp = 0;
}

eventEmitter(DynamicCanvasAsset);

DynamicCanvasAsset.prototype.dynamic = true;

/**
 * Destructor.
 */
DynamicCanvasAsset.prototype.destroy = function() {
  clearOwnProperties(this);
};

DynamicCanvasAsset.prototype.element = function() {
  return this._element;
};

DynamicCanvasAsset.prototype.width = function() {
  return this._element.width;
};

DynamicCanvasAsset.prototype.height = function() {
  return this._element.height;
};

DynamicCanvasAsset.prototype.timestamp = function() {
  return this._timestamp;
};

/**
 * Notifies that the contents of the canvas were modified.
 */
DynamicCanvasAsset.prototype.changed = function() {
  this._timestamp++;
  this.emit('change');
};

module.exports = DynamicCanvasAsset;
