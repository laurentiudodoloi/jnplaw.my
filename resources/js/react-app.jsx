import React from 'react'
import ReactDOM from 'react-dom'

import LoadingScreen from 'react-loading-screen';
import { isMobile } from 'react-device-detect';

import ScrollableGallery from './components/ScrollableGallery'

class App extends React.Component {
    state = {
        loading: true
    }

    constructor(props) {
        super(props);

        const root = document.getElementById('gallery-target')
        const feed = JSON.parse(root.dataset.feed)

        if (isMobile) {
            this.slides = feed.slides.mobile
        } else {
            this.slides = feed.slides.desktop
        }

        if (!this.slides) {
            this.slides = []
        }

        this.logo = feed.company_logo

        this.stopLoading = this.stopLoading.bind(this)
    }

    stopLoading (val) {
        setTimeout(() => {
            this.setState({
                loading: false
            })
        }, 500)
    }

    render() {
        return (
            <div className={'react-application'}>
                <LoadingScreen
                    loading={this.state.loading}
                    bgColor='#000000'
                    spinnerColor='#ffffff'
                    textColor='#ffffff'
                    children=""
                    text='Joseph & Partners'
                />

                <ScrollableGallery
                    style={ { width: '100vw', height: '100vh' } }
                    slides={this.slides}
                    logo={this.logo}
                    onLoaded={(val) => this.stopLoading(val)}
                />
            </div>
        )
    }
}

ReactDOM.render(
    React.createElement(App, {}, null),
    document.getElementById('gallery-target')
);
