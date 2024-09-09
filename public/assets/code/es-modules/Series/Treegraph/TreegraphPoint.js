/* *
 *
 *  (c) 2010-2024 Pawel Lysy Grzegorz Blachlinski
 *
 *  License: www.highcharts.com/license
 *
 *  !!!!!!! SOURCE GETS TRANSPILED BY TYPESCRIPT. EDIT TS FILE ONLY. !!!!!!!
 *
 * */
'use strict';
import Point from '../../Core/Series/Point.js';
import SeriesRegistry from '../../Core/Series/SeriesRegistry.js';
const { seriesTypes: { treemap: { prototype: { pointClass: TreemapPoint } } } } = SeriesRegistry;
import U from '../../Core/Utilities.js';
const { addEvent, fireEvent, merge } = U;
/* *
 *
 *  Class
 *
 * */
/**
 * @private
 * @class
 */
class TreegraphPoint extends TreemapPoint {
    constructor() {
        /* *
         *
         *  Properties
         *
         * */
        super(...arguments);
        this.isLink = false;
        this.setState = Point.prototype.setState;
    }
    /* *
     *
     *  Functions
     *
     * */
    draw() {
        super.draw.apply(this, arguments);
        // run animation of hiding/showing of the point.
        let graphic = this.graphic;
        if (graphic) {
            graphic.animate({
                visibility: this.visible ? 'inherit' : 'hidden'
            });
        }
        this.renderCollapseButton();
    }
    renderCollapseButton() {
        const point = this, series = point.series, parentGroup = point.graphic && point.graphic.parentGroup, levelOptions = series.mapOptionsToLevel[point.node.level || 0] || {}, btnOptions = merge(series.options.collapseButton, levelOptions.collapseButton, point.options.collapseButton), { width, height, shape, style } = btnOptions, padding = 2, chart = this.series.chart, calculatedOpacity = (point.visible &&
            (point.collapsed ||
                !btnOptions.onlyOnHover ||
                point.state === 'hover')) ? 1 : 0;
        if (!point.shapeArgs) {
            return;
        }
        this.collapseButtonOptions = btnOptions;
        if (!point.collapseButton) {
            if (!point.node.children.length || !btnOptions.enabled) {
                return;
            }
            const { x, y } = this.getCollapseBtnPosition(btnOptions), fill = (btnOptions.fillColor ||
                point.color ||
                "#cccccc" /* Palette.neutralColor20 */);
            point.collapseButton = chart.renderer
                .label(point.collapsed ? '+' : '-', x, y, shape)
                .attr({
                height: height - 2 * padding,
                width: width - 2 * padding,
                padding: padding,
                fill,
                rotation: chart.inverted ? 90 : 0,
                rotationOriginX: width / 2,
                rotationOriginY: height / 2,
                stroke: btnOptions.lineColor || "#ffffff" /* Palette.backgroundColor */,
                'stroke-width': btnOptions.lineWidth,
                'text-align': 'center',
                align: 'center',
                zIndex: 1,
                opacity: calculatedOpacity,
                visibility: point.visible ? 'inherit' : 'hidden'
            })
                .addClass('highcharts-tracker')
                .addClass('highcharts-collapse-button')
                .removeClass('highcharts-no-tooltip')
                .css(merge({
                color: typeof fill === 'string' ?
                    chart.renderer.getContrast(fill) :
                    "#333333" /* Palette.neutralColor80 */
            }, style))
                .add(parentGroup);
            point.collapseButton.element.point = point;
        }
        else {
            if (!point.node.children.length || !btnOptions.enabled) {
                point.collapseButton.destroy();
                delete point.collapseButton;
            }
            else {
                const { x, y } = this.getCollapseBtnPosition(btnOptions);
                point.collapseButton
                    .attr({
                    text: point.collapsed ? '+' : '-',
                    rotation: chart.inverted ? 90 : 0,
                    rotationOriginX: width / 2,
                    rotationOriginY: height / 2,
                    visibility: point.visible ? 'inherit' : 'hidden'
                })
                    .animate({
                    x,
                    y,
                    opacity: calculatedOpacity
                });
            }
        }
    }
    toggleCollapse(state) {
        const series = this.series;
        this.update({
            collapsed: state ?? !this.collapsed
        }, false, void 0, false);
        fireEvent(series, 'toggleCollapse');
        series.redraw();
    }
    destroy() {
        if (this.collapseButton) {
            this.collapseButton.destroy();
            delete this.collapseButton;
            this.collapseButton = void 0;
        }
        if (this.linkToParent) {
            this.linkToParent.destroy();
            delete this.linkToParent;
        }
        super.destroy.apply(this, arguments);
    }
    getCollapseBtnPosition(btnOptions) {
        const point = this, chart = point.series.chart, inverted = chart.inverted, btnWidth = btnOptions.width, btnHeight = btnOptions.height, { x = 0, y = 0, width = 0, height = 0 } = point.shapeArgs || {};
        return {
            x: x +
                btnOptions.x +
                (inverted ? -btnHeight * 0.3 : width + btnWidth * -0.3),
            y: y + height / 2 - btnHeight / 2 + btnOptions.y
        };
    }
}
addEvent(TreegraphPoint, 'mouseOut', function () {
    const btn = this.collapseButton, btnOptions = this.collapseButtonOptions;
    if (btn && btnOptions?.onlyOnHover && !this.collapsed) {
        btn.animate({ opacity: 0 });
    }
});
addEvent(TreegraphPoint, 'mouseOver', function () {
    if (this.collapseButton && this.visible) {
        this.collapseButton.animate({ opacity: 1 }, this.series.options.states?.hover?.animation);
    }
});
// Handle showing and hiding of the points
addEvent(TreegraphPoint, 'click', function () {
    this.toggleCollapse();
});
/* *
 *
 *  Export Default
 *
 * */
export default TreegraphPoint;
