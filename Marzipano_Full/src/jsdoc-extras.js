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

// This file contains no executable code, only documentation.

/**
 * @interface Size
 *
 * The dimensions of a rectangular region.
 *
 * @property {number} width The width in pixels.
 * @property {number} height The height in pixels.
 */


/**
 * @interface Coords
 *
 * A pair of screen coordinates.
 *
 * @property {number} x The horizontal coordinate.
 *     The horizontal axis points right.
 * @property {number} y The vertical coordinate.
 *     The vertical axis points down.
 */


/**
 * @interface RectSpec
 *
 * A rectangular region expressed in relative (normalized), absolute (pixels),
 * or mixed coordinates. A missing value is interpreted as the minimum or
 * maximum value for the respective dimension. Where an absolute and a relative
 * value are in conflict, the absolute value takes precedence.
 *
 * @property {number} relativeX The relative horizontal offset.
 * @property {number} relativeY The relative vertical offset.
 * @property {number} relativeWidth The relative width.
 * @property {number} relativeHeight The relative height.
 * @property {number} absoluteX The absolute horizontal offset.
 * @property {number} absoluteY The absolute vertical offset.
 * @property {number} absoluteWidth The absolute width.
 * @property {number} absoluteHeight The absolute height.
 */

/**
 * @interface Rect
 *
 * A rectangular region in normalized coordinates.
 *
 * @property {number} x The horizontal offset.
 * @property {number} y The vertical offset.
 * @property {number} width The width.
 * @property {number} width The height.
 */

/**
 * @interface View
 *
 * Defines the camera direction, aperture and projection used to
 * render media.
 *
 * This is an abstract interface; the concrete implementations are
 * {@link RectilinearView} and {@link FlatView}.
 */

/**
 * The view type, used by the {@link Stage} to determine the appropriate
 * renderer for a given geometry and view.
 *
 * Known values are `"rectilinear"` and `"flat"`.
 *
 * See also {@link Stage#registerRenderer}.
 *
 * @property {string}
 * @name View#type
 */

/**
 * Signals that the view has changed.
 * @event View#change
 */

/**
 * Signals that the size the view is using has changed.
 * @event View#resize
 */

/**
 * @interface ImageLoader
 * @classdesc Creates {@link Asset assets} by loading images.
 */

/**
 * Loads an {@link Asset} from an image.
 * @function
 * @name ImageLoader.prototype.loadImage
 * @param {string} url The image URL.
 * @param {?Rect} rect A {@link Rect} describing a portion of the image, or null
 *     for the full image.
 * @param {function(?Error, Asset)} done The callback.
 * @return {function()} A function to cancel loading.
 */

/**
 * @interface Source
 * @classdesc A source that loads 360° media.
 */

/**
 * Loads an asset from the source.
 * @function
 * @name Source.prototype.loadAsset
 * @param {Stage} stage
 * @param {Tile} tile
 * @param {Function} done Callback.
 * @returns {Function} Function that cancels the loading when called.
 */

/**
 * @interface Asset
 * @classdesc Asset loaded by a {@link Source}
 * @property {boolean} dynamic Whether the asset can change, requiring its
 * texture to be refreshed. Dynamic assets should fire
 * {@link Asset#event:change} when they change.
 */

/**
 * Destroys the instance.
 * @function
 * @name Asset.prototype.destroy
 */

/**
 * Retrieves the element that will be used for rendering.
 * @function
 * @name Asset.prototype.element
 * @returns {*} Something that the Texture can use to refresh itself. e.g. for
 * CssTexture, this is some value that can be used in
 * CanvasRenderingContext2D.drawImage().
 */

/**
 * Retrieves the width of the Asset.
 * @function
 * @name Asset.prototype.width
 * @returns {number}
 */

/**
 * Retrieves the height of the Asset.
 * @function
 * @name Asset.prototype.height
 * @returns {number}
 */

/**
 * Retrieves a timestamp which identifies the current version of the Asset.
 * This is used to prevent dynamic textures from refreshing when not necessary.
 * @function
 * @name Asset.prototype.timestamp
 * @returns {number}
 */

/**
 * Signals that the asset has changed.
 * @event Asset#change
 */

/**
 * @interface Effects
 * @classdesc Effects to be applied on the rendering
 * @property {Number} opacity Between 1 (fully opaque) and 0 (fully transparent)
 * @property {RectSpec} rect The rectangular region on which to render. Useful
 *     for side-by-side rendering or to otherwise compose a scene from
 *     non-overlapping layers.
 * @property {vec4} colorOffset
 * @property {mat4} colorMatrix
 * @property {Rect} textureCrop Use only a portion of the texture when
 *     rendering. Only supported on {@link WebGlEquirectRenderer}. Useful for
 *     rendering stereoscopic 360° video.
 */

/**
 * @interface Geometry
 *
 * @classdesc
 * A Geometry describes a partitioning of the view space into
 * {@link Tile tiles}.
 *
 * This is an abstract interface; the concrete implementations are
 * {@link CubeGeometry}, {@link EquirectGeometry} and {@link FlatGeometry}.
 */

/**
 * The geometry type, used by the {@link Stage} to determine the appropriate
 * renderer for a given geometry and view.
 *
 * Known values are `"cube"`, `"equirect"` and `"flat"`.
 *
 * See also {@link Stage#registerRenderer}.
 *
 * @property {string}
 * @name Geometry#type
 */

/**
 * Return the set of visible tiles for the given view and level. If a result
 * array is supplied, it is filled in with the result and returned. Otherwise,
 * a fresh array is returned.
 * @function
 * @name Geometry#visibleTiles
 * @param {View} view
 * @param {Level} level
 * @return {Tile[]} result
 */

/**
 * @interface Tile
 *
 * @classdesc
 * A Tile is one of the partitions of a {@link Geometry}.
 *
 * This is an abstract interface; the concrete implementations are
 * {@link CubeTile}, {@link EquirectTile} and {@link FlatTile}.
 */

/**
 * Tile hash function.
 * @function
 * @name Tile.hash
 * @param {Tile} tile
 * @returns {number}
 */

/**
 * Tile equality predicate.
 * @function
 * @name Tile.equals
 * @param {Tile} tile1
 * @param {Tile} tile2
 * @returns {boolean}
 */

/**
 * Tile comparison function. Sorts tiles in bottom-to-top stacking order.
 * @function
 * @name Tile.cmp
 * @param {Tile} tile1
 * @param {Tile} tile2
 * @returns {number}
 */

/**
 * @interface Renderer
 *
 * @classdesc
 * A Renderer is responsible for rendering tiles of a given {@link Geometry},
 * according to a given {@link View}, onto a {@link Stage}.
 *
 * This is an abstract interface.
 */

/**
 * Signals the start of a frame for a layer.
 *
 * Must be matched by a later call to {@link Renderer#endFrame} with the same
 * arguments. Calls to {@link Renderer#renderTile} must occur in between.
 *
 * @function
 * @name Renderer#startLayer
 * @param {Layer} layer The layer onto which to render.
 * @param {Rect} rect The rectangular region into which to render.
 */

/**
 * Renders a tile into a layer within the current frame.
 *
 * @function
 * @name Renderer#renderTile
 * @param {Tile} tile The tile to be rendered.
 * @param {Texture} texture The texture to be rendered.
 * @param {Layer} layer The layer onto which to render.
 * @param {number} layerZ The z-index of the tile within the layer.
 */

/**
 * Signals the end of a frame for a layer.
 *
 * Must be matched by an earlier call to {@link Renderer#startFrame} with the
 * same arguments. Calls to {@link Renderer#renderTile} must occur in between.
 *
 * @function
 * @name Renderer#endLayer
 * @param {Layer} layer The layer onto which to render.
 * @param {Rect} rect The rectangular region into which to render.
 */

/**
 * @interface ControlMethod
 * @classdesc A method to control the view
 *
 * A ControlMethod works by emitting the `parameterDynamics` event with the
 * following arguments:
 *
 *  - The name of the parameter it affects
 *  - A {@link Dynamics} instance with the movement information
 *
 * The parameter may be one of the following: `x`, `y`, `axisScaledX`,
 * `axisScaledY`, `zoom`, `yaw`, `pitch`.
 *
 * These parameters are scaled differently by each view. For instance,
 * {@link RectilinearView} interprets `x` and a change in `yaw` scaled by the
 * current fov.
 *
 * **ATTENTION**: the parameter definitions are likely to be refactored in the
 * future.
 *
 * The `active` and `inactive` events must also be emitted when the user starts
 * or finishes interacting with the controls.
 */

/**
 * Signals that interaction with this control method has started.
 * @event ControlMethod#active
 */

/**
 * Signals that interaction with this control method has stopped.
 * @event ControlMethod#inactive
 */

/**
 * Signals a change in a control parameter.
 * @event ControlMethod#parameterDynamics
 * @param {!string} parameter The name of the parameter that is being affected.
 * @param {!Dynamics} dynamics How the parameter changed since the last such
 * event.
 */

/**
 * @namespace util
 */
