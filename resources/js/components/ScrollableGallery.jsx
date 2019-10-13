import React from 'react'
import PropTypes from 'prop-types'

import { Player } from 'video-react'

import Fade from 'react-reveal/Fade';
import Reveal from 'react-reveal/Reveal';

import raf from 'raf'
import sizeMe from 'react-sizeme'
import { Swipeable } from 'react-swipeable'

import Gallery from './Gallery'

const noop = () => undefined

import { throttle } from 'lodash';

class ScrollableGallery extends React.Component {
    state = {
        currentSlide: 0,
        lastScroll: 0,
        playResource: false
    }

    constructor(props) {
        super(props);

        this.sliders = [];

        this._onPressEscape = this._onPressEscape.bind(this);
    }

    _onPressEscape (event){
        if(event.keyCode === 27) {
            this.resourceOff()
        }
    }

    resourceOff = () => {
        this.setState({
            ...this.state,
            playResource: false
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
        }),
        onLoaded: PropTypes.func,
    }

    static defaultProps = {
        onChange: noop,
        style: {}
    };

    _current = 0

    componentWillReceiveProps(props) {
        this._onResize()
    }

    componentDidMount() {
        let domSliders = document.querySelectorAll('.video-slider');
        domSliders.forEach(s => {
            this.sliders.push(s.textContent);
        })

        document.querySelector('body').style.overflow = 'hidden';

        document.querySelector('canvas').style.overflow = 'hidden'

        window.addEventListener('resize', this._onResize)

        this.addWheelEvent()

        window.addEventListener('touchmove', this._onWheel)

        document.addEventListener("keydown", this._onPressEscape);

        if (typeof this.props.onChange === 'function') {
            const { onLoaded } = this.props

            onLoaded(5);
        }

        this._reset(this.props)

        this._tick()
    }

    onClickPlay (evt, index) {
        evt.preventDefault();

        this.setState({
            ...this.state,
            playResource: 'storage/uploads/' + this.props.projects[index].resource_url
        })
    }

    addWheelEvent () {
        window.addEventListener('wheel', throttle(this._onWheel, 100));
    }

    removeWheelEvent () {
        window.removeEventListener('wheel', throttle(this._onWheel, 100));
    }

    componentWillUnmount() {
        window.removeEventListener('resize', this._onResize)
        document.removeEventListener("keydown", this._onPressEscape);
        this.removeWheelEvent()

        if (this._tickRaf) {
            raf.cancel(this._tickRaf)
            this._tickRaf = null
        }
    }

    render () {
        const {
            slides,
            startAt,
            onChange,
            style,
            ...rest
        } = this.props

        return (
            <div>
                {this.state.playResource &&
                    <div className={'slider-resource-player'}>
                        <a href={'#'} className={'close-btn'} onClick={this.resourceOff}>x</a>

                        {this.state.playResource.includes('mp4') &&
                            <Player
                                className={'canvas-video-player'}
                                aspectRatio={'16:9'}
                                isFullscreen
                                src={this.state.playResource}
                                autoPlay={true}
                                preload={'auto'}
                            />
                        }

                        {!this.state.playResource.includes('mp4') &&
                            <img
                                src={this.state.playResource}
                                className={'canvas-image-player'}
                            />
                        }
                    </div>
                }

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

                <div className="landing-page section-wrapper">
                    <div className="header-wrap">
                        <div className="brand" style={{color: '#ffffff'}}>
                            <a className="text-decoration-none text-white" href="/">
                                <img src={this.props.logo} alt="Company logo" className="logo-image"/>
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

                    <ul className="onepage-dots slider-vertical-numbers">
                        {this.sliders.map((slide, i) => (
                            <li key={i}
                                className={this.state.currentSlide === i ? 'active' : ''}></li>
                        ))}
                    </ul>

                    <div className="content-wrap">
                        {this.props.projects.map((project, index) => (
                            <div key={index} hidden={index !== this.state.currentSlide} className="container">
                                <div className={'row'}>
                                    <div className={'col-sm-6 offset-sm-1'}>
                                        <span className="date text-uppercase" hidden={true}>march 20, 2017</span>

                                        <div className="mb-3">
                                            <Reveal>
                                                <span className="tag text-capitalize">{project.subtitle}</span>
                                            </Reveal>
                                        </div>

                                        <Reveal>
                                            <h2 className='title text-left anime-text'>
                                                {project.title}
                                            </h2>
                                        </Reveal>

                                        <Fade>
                                            <div className="play-video norebro-video-module-sc video-module">
                                                <div className="btn-play">
                                                    <a href="#">
                                                        <i className="fa fa-play"></i>
                                                    </a>
                                                </div>
                                                <div className="wrap">
                                                    <div
                                                        className="play-content"
                                                        onClick={(evt) => this.onClickPlay(evt, index)}
                                                    >
                                                        <a href="#">
                                                            Play video
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </Fade>
                                    </div>
                                </div>
                            </div>
                        ))}
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
        let currentSlide = this.state.currentSlide

        if (event.deltaY > 0) {
            currentSlide++
        } else {
            currentSlide--
        }

        if (currentSlide < 0) {
            currentSlide = this.sliders.length - 1
        }

        currentSlide = currentSlide % this.sliders.length

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

            this.setState({
                currentSlide: Math.round(this._gallery._position) % this.sliders.length
            })
        }
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

    _tick = async () => {
        const {
            onChange
        } = this.props

        let slideIndex = await this._gallery.update()

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
