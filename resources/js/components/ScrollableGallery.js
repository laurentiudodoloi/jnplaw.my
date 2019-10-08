import React, { Component } from 'react'
import PropTypes from 'prop-types'

import Fade from 'react-reveal/Fade';
import Flash from 'react-reveal/Flash';
import Animation from 'react-reveal/Animation';
import Jump from 'react-reveal/Jump';
import Reveal from 'react-reveal/Reveal';
import Slide from 'react-reveal/Slide';
import Step from 'react-reveal/Step';
import Swing from 'react-reveal/Swing';
import Wobble from 'react-reveal/Wobble';

import raf from 'raf'
import sizeMe from 'react-sizeme'
import { Swipeable } from 'react-swipeable'

import Gallery from './Gallery'

const noop = () => undefined

import { throttle } from 'lodash';

class ScrollableGallery extends Component {
    state = {
        canScroll: true,
        lastScroll: 0
    }

    constructor(props) {
        super(props);

        this.currentSlide = 0
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

        // window.addEventListener('touchmove', this._onWheel)

        this._reset(this.props)

        this._tick()
    }

    addWheelEvent () {
        window.addEventListener('wheel', throttle(this._onWheel, 100));
    }

    removeWheelEvent () {
        window.addEventListener('wheel', throttle(this._onWheel, 2000));
    }

    componentWillUnmount() {
        window.removeEventListener('resize', this._onResize)
        this.removeWheelEvent()

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
            <div>
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
                        style={{
                            width: '100%',
                            height: '100%'
                        }}
                    />
                </Swipeable>

                <ul className="onepage-dots slider-vertical-numbers">
                    {this.sliders.map((slide, i) => (
                        <li key={i}
                            className={this.currentSlide === i ? 'active' : ''}></li>
                    ))}
                </ul>

                <div className="landing-page section-wrapper">
                    <div className="header-wrap">
                        <div className="brand" style={{color: '#ffffff'}}>
                            <a className="text-decoration-none text-white" href="/">
                                <img id={'logo-image'} src={this.props.logo} alt="Company logo" className="img-fluid"/>
                            </a>
                        </div>

                        <div className="header-right">
                            <ul className="nav">
                                <li className="nav-item">
                                    <a className="nav-link text-white hidden" href="#">
                                        <i className="fa fa-search"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div className="content-wrap">

                        <div className="content">
                            <span className="date text-uppercase">march 20, 2017</span>

                            <div className="mb-3">
                                {this.props.projects.map((project, index) => (
                                    <div key={index} hidden={index !== this.currentSlide}>
                                        <Reveal>
                                            <span className="tag text-capitalize">{project.header_title}</span>
                                        </Reveal>
                                    </div>
                                ))}
                            </div>
                            {this.props.projects.map((project, index) => (
                                <div key={index} hidden={index !== this.currentSlide}>
                                    <Reveal>
                                        <h2 className='title text-left anime-text'>
                                            {project.title}
                                        </h2>
                                    </Reveal>
                                </div>
                            ))}

                            {this.props.projects.map((project, index) => (
                                <div key={index} hidden={index !== this.currentSlide}>
                                    <Fade>
                                        <div className="info-list">
                                            {project.description}
                                        </div>
                                    </Fade>
                                </div>
                            ))}

                            {this.props.projects.map((project, index) => (
                                <div key={index} hidden={index !== this.currentSlide}>
                                    <Fade>
                                        <div className="play-video norebro-video-module-sc video-module">
                                            <div className="btn-play">
                                                <a href="#">
                                                    <i className="fa fa-play"></i>
                                                </a>
                                            </div>
                                            <div className="content-center">
                                                <div className="wrap">
                                                    <div className="play-content">
                                                        <a href="#">
                                                            Play video
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </Fade>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className="scroll">Scroll</div>
                </div>
            </div>
        )
    }

    _containerRef = (ref) => {
        this._container = ref
    }

    _canvasRef = (ref) => {
        this._canvas = ref
    }

    processCurrentSlide (event) {
        if (event.deltaY > 0) {
            this.currentSlide++
        } else {
            this.currentSlide--
        }

        if (this.currentSlide < 0) {
            this.currentSlide = this.sliders.length - 1
        }

        this.currentSlide = this.currentSlide % this.sliders.length

        console.log('CURRENT', this.currentSlide);

        let animatedText = document.querySelector('.title')

        if (animatedText) {
            this.hideTextAnimation(animatedText);

            void animatedText.offsetWidth;
            void animatedText.offsetHeight;

            this.showTextAnimation(animatedText);

            animatedText.style.opacity = 1;
            animatedText.style.top = 0;
            animatedText.classList.add('move-text');

            animatedText.classList.remove('move-text');
        }
    }

    hideTextAnimation (animatedText) {
        animatedText.style.top = 0;
        animatedText.style.opacity = 0;
        animatedText.classList.remove('move-text');
    }

    showTextAnimation (animatedText) {
        animatedText.style.opacity = 1;
        animatedText.style.top = 0;
        animatedText.classList.add('move-text');
    }

    _onWheel = (event) => {
        if (event) {
            this._gallery.onScroll(event)
            this.processCurrentSlide(event)
        }

        // if (this.state.canScroll) {
        //
        //
        //     // setInterval(() => {
        //     // },1000);
        //
        //     // this.setState({
        //     //     canScroll: false
        //     // })
        // }
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
