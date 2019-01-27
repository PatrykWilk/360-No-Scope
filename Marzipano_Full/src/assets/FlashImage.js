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
 * @class FlashImageAsset
 * @implements Asset
 * @classdesc
 *
 * Static asset referencing an image loaded by a Flash application.
 *
 * @param {Element} flashElement HTML element with the Flash application that
 *     loaded the image.
 * @param {number} imageId Unique ID of the image inside the Flash application.
 */
function FlashImageAsset(flashElement, imageId) {
  this._flashElement = flashElement;
  this._imageId = imageId;
}

FlashImageAsset.prototype.dynamic = false;

/**
 * Destructor.
 */
FlashImageAsset.prototype.destroy = function() {
  this._flashElement.unloadImage(this._imageId);
  clearOwnProperties(this);
};

FlashImageAsset.prototype.element = function() {
  return this._imageId;
};

FlashImageAsset.prototype.width = function() {
  // TODO: Return the real value.
  return 0;
};

FlashImageAsset.prototype.height = function() {
  // TODO: Return the real value.
  return 0;
};

FlashImageAsset.prototype.timestamp = function() {
  return 0;
};

module.exports = FlashImageAsset;
