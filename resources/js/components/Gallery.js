import * as THREE from 'three'
import isVideo from 'is-video'

import fragmentShader from './graphics/fragment'
import vertexShader from './graphics/vertex'

export default class Gallery {
    constructor(opts) {
        this.events = [
            'finish-scroll-animation'
        ]

        this.callbacks = {}

        const {
            canvas,
            slides,
            current = 0
        } = opts

        const {
            width,
            height
        } = canvas

        // TODO: why is this necessary on safari with three.js?
        if (window.ImageBitmap === undefined) {
            window.ImageBitmap = function () { }
        }

        this._canvas = canvas
        this._textureLoader = new THREE.TextureLoader()
        this._textures = slides.map(this._initTexture)

        this._time = 0
        this._speed = 0
        this._position = current

        this._renderer = new THREE.WebGLRenderer({ canvas })

        this._camera = new THREE.PerspectiveCamera(70, width / height, 0.001, 100)
        this._camera.position.set(0, 0, 1)

        this._material = new THREE.ShaderMaterial({
            side: THREE.DoubleSide,
            vertexShader,
            fragmentShader,
            uniforms: {
                time: { type: 'f', value: this._time },
                pixels: { type: 'v2', value: new THREE.Vector2(width, height) },
                accel: { type: 'v2', value: new THREE.Vector2(0.5, 2) },
                progress: { type: 'f', value: 5.0 },
                uvRate1: {
                    value: new THREE.Vector2(1, 1)
                },
                texture1: {
                    value: this._textures[this.currentSlideIndex]
                },
                texture2: {
                    value: this._textures[this.nextSlideIndex]
                }
            }
        })

        // this._plane = new THREE.Mesh(this.widthBasedGeometry(width), this._material)
        this._plane = new THREE.Mesh(this.widthBasedGeometry(width), this._material)

        this._scene = new THREE.Scene()
        this._scene.add(this._plane)

        this.resize()
    }

    deviceGeometryHeight(width) {
        if (width < 361) {
            return 1.8;
        }

        return 1;
    }

    widthBasedGeometry(width) {
        let dh = this.deviceGeometryHeight(width);

        dh = 1;
        return new THREE.PlaneBufferGeometry(dh, dh);
    }

    resize() {
        const {
            width,
            height
        } = this._canvas

        this._renderer.setSize(width, height)
        this._camera.aspect = width / height

        this._material.uniforms.uvRate1.value.y = height / width

        const dist = this._camera.position.z - this._plane.position.z
        this._camera.fov = 2 * (180 / Math.PI) * Math.atan(1.0 / (2 * dist))

        // this._plane = new THREE.Mesh(this.widthBasedGeometry(width), this._material)

        this._plane.scale.x = width / height

        this._camera.updateProjectionMatrix()

        this._textures.forEach(this._updateTextureOnResize)
    }

    _initTexture = (src) => {
        if (isVideo(src)) {
            const video = document.createElement('video')
            video.crossOrigin = "anonymous";
            video.muted = true
            video.loop = true
            video.autoplay = true

            const texture = new THREE.VideoTexture(video)
            texture.minFilter = THREE.LinearFilter
            texture.maxFilter = THREE.LinearFilter
            video.addEventListener('load', () => this._updateTextureOnResize(texture))
            video.addEventListener('loadedmetadata', () => this._updateTextureOnResize(texture))

            video.src = src
            video.load()
            const play = video.play()
            if (play) {
                play.catch(() => undefined)
            }

            return texture
        } else {
            const texture = this._textureLoader.load(src, this._updateTextureOnResize)
            return texture
        }
    }

    _updateTextureOnResize = (texture) => {
        // TODO: we want to mimic background-size: cover by default. another
        // workaround is needed, sinced changing texture wrapS/wrapT and UV
        // matrix only works with textures that are sized power of two
    }

    get currentSlideIndex() {
        const n = this._textures.length
        return (Math.floor(this._position) + n) % n
    }

    get nextSlideIndex() {
        const n = this._textures.length
        return (this.currentSlideIndex + 1) % n
    }

    onScroll = (event) => {
        let deltaY = event.deltaY

        if (deltaY < 0) {
            deltaY -= 55.0
        } else {
            deltaY += 55.0
        }

        this._speed += deltaY * 0.0012
    }

    update () {
        this._time += 0.15
        this._material.uniforms.time.value = this._time

        this._position += this._speed
        this._speed *= 0.7

        const n = this._textures.length
        const posI = Math.round(this._position)
        const diff = posI - this._position

        this._position += diff * 0.02

        if (Math.abs(posI - this._position) < 0.001) {
            this._position = posI
        }

        if (this._position < 0) {
            this._position += n
        }

        this._material.uniforms.progress.value = this._position

        const currentSlide = this.currentSlideIndex
        const nextSlide = this.nextSlideIndex

        this._material.uniforms.texture1.value = this._textures[currentSlide]
        this._material.uniforms.texture2.value = this._textures[nextSlide]

        const relativePosition = Math.floor(this._position)
        if (relativePosition >= this._position) {
            this.callbacks['finish-scroll-animation']()
        }

    }

    on (event, callback) {
       if (this.events.find(e => event)) {

           this.callbacks[event] = callback
       }
    }

    render() {
        this._renderer.render(this._scene, this._camera)
    }
}
