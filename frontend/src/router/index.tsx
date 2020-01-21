import React from 'react';
import axios from "axios";
import { App } from "./app";
import { Switch, Route, Redirect } from 'react-router';

import { Constants } from '../constants'
import { LocalStorage } from '../factory/localStorage';

import Login from '../modules/login';
import Home from '../modules/home';
import Account from '../modules/accont';
import Transaction from '../modules/transaction';

const isAuthenticated = () => LocalStorage.get(Constants.STORAGE_TOKEN);
axios.defaults.headers.common['Authorization'] =isAuthenticated();

export const Routes: React.FC = () =>
    <Switch>
        <Route exact path="/" component={Login} />
        <PrivateRoute path="/home" component={Home} />
        <PrivateRoute path="/account" component={Account} />
        <PrivateRoute path="/transaction" component={Transaction} />
        <Redirect from="*" to="/home"/>
    </Switch>;

const PrivateRoute: React.FC<any>  = ({ component: Component, ...rest }) => (
    <Route
        {...rest}
        render={props =>
            isAuthenticated() ?
                <App>
                    <Component {...props} />
                </App>
                :
                <Redirect to={{ pathname: "/", state: { from: props.location } }} />
        }
    />
);