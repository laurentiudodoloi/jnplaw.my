import React, {Component} from 'react'
import ReactDOM from 'react-dom'

import ScrollableGallery from './components/ScrollableGallery'

class App extends Component {
    render() {
        return (
            <ScrollableGallery
                style={ { width: '100vw', height: '100vh' } }
                slides={ [] }
            />
        )
    }
}

ReactDOM.render(
    React.createElement(App, {}, null),
    document.getElementById('gallery-target')
);
