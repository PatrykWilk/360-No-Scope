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

var clearOwnProperties = require('../util/clearOwnProperties');

/**
 * @class StaticCanvasAsset
 * @implements Asset
 * @classdesc
 *
 * Static asset containing an HTML canvas element.
 *
 * @param {Element} element
 */
function StaticCanvasAsset(element) {
  this._element = element;
}

StaticCanvasAsset.prototype.dynamic = false;

/**
 * Destructor.
 */
StaticCanvasAsset.prototype.destroy = function() {
  clearOwnProperties(this);
};

StaticCanvasAsset.prototype.element = function() {
  return this._element;
};

StaticCanvasAsset.prototype.width = function() {
  return this._element.width;
};

StaticCanvasAsset.prototype.height = function() {
  return this._element.height;
};

StaticCanvasAsset.prototype.timestamp = function() {
  return 0;
};

module.exports = StaticCanvasAsset;
