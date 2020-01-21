import './conf';
import './template';

import React from 'react';

import store from './store';
import { Provider } from 'react-redux';
import { history } from './router/history';
import { ConnectedRouter } from 'connected-react-router';

import { render } from 'react-dom';
import { Routes } from './router';

render(
    <Provider store={store}>
        <ConnectedRouter history={history}>
            <Routes />
        </ConnectedRouter>
    </Provider>
, document.getElementById('root'));
