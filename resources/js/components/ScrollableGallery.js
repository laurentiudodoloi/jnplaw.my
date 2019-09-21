import React, { Component } from 'react'
import PropTypes from 'prop-types'

import raf from 'raf'
import sizeMe from 'react-sizeme'
import { Swipeable } from 'react-swipeable'

import Gallery from './Gallery'

const noop = () => undefined

class ScrollableGallery extends Component {
    constructor(props) {
        super(props);

        this.sliders = [];

        let domSliders = document.querySelectorAll('.video-slider');
        domSliders.forEach(s => {
            this.sliders.push(s.textContent);
        })
    }

    static propTypes = {
        slides: PropTypes.arrayOf(PropTypes.string),
        startAt: PropTypes.number,
        onChange: PropTypes.func,
        style: PropTypes.object,
        size: PropTypes.shape({
            width: PropTypes.number,
            height: PropTypes.number
        })
    }

    static defaultProps = {
        onChange: noop,
        style: { }
    };

    _current = 0

    componentWillReceiveProps(props) {
        this._onResize()
    }

    componentDidMount() {
        document.querySelector('body').style.overflow = 'hidden';

        document.querySelector('canvas').style.overflow = 'hidden'

        window.addEventListener('resize', this._onResize)

        this.addWheelEvent()

        // window.addEventListener('scroll', this._onWheel)
        window.addEventListener('touchmove', this._onWheel)

        this._reset(this.props)
        this._tick()
    }

    addWheelEvent () {
        window.addEventListener('wheel', this._onWheel)
    }

    removeWheelEvent () {
        window.removeEventListener('wheel', this._onWheel)
    }

    componentWillUnmount() {
        window.removeEventListener('resize', this._onResize)
        this.addWheelEvent()
        window.removeEventListener('touchmove', this._onWheel)

        if (this._tickRaf) {
            raf.cancel(this._tickRaf)
            this._tickRaf = null
        }
    }

    render() {
        const {
            slides,
            startAt,
            onChange,
            style,
            ...rest
        } = this.props

        return (
            <Swipeable
                style={{
                    width: '100%',
                    height: '100%',
                    overflow: 'hidden',
                    ...style
                }}
                {...rest}
                preventDefaultTouchmoveEvent={true}
                onSwiped={this._onSwiped}
                innerRef={this._containerRef}
            >
                <canvas
                    ref={this._canvasRef}
                    onWheel={this._onWheel}
                    style={{
                        width: '100%',
                        height: '100%'
                    }}
                />
            </Swipeable>
        )
    }

    _containerRef = (ref) => {
        this._container = ref
    }

    _canvasRef = (ref) => {
        this._canvas = ref
    }

    _onWheel = (event) => {
        this._gallery.onScroll(event)
    }

    _onSwiped = (event, deltaX, deltaY, isFlick) => {
        return true

        if (isFlick) {
            deltaY *= 5
        }

        this._gallery.onScroll({
            ...event,
            deltaY
        })
    }

    _onResize = () => {
        this._canvas.width = this._container.clientWidth
        this._canvas.height = this._container.clientHeight

        if (this._gallery) {
            this._gallery.resize()
        }
    }

    _tick = () => {
        const {
            onChange
        } = this.props

        this._gallery.update()
        this._gallery.render()

        if (this._current !== this._gallery.currentSlideIndex) {
            this._current = this._gallery.currentSlideIndex
            onChange(this._current)
        }

        this._tickRaf = raf(this._tick)
    }

    _reset(props) {
        const {
            slides
        } = props

        this._onResize()

        const videoSlides = this.sliders

        this._gallery = new Gallery({
            canvas: this._canvas,
            slides: videoSlides,
            current: this._current
        })
    }
}

export default sizeMe({ monitorWidth: true, monitorHeight: true })(ScrollableGallery)
