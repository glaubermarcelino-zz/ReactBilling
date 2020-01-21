import { Request } from './request';
import { Constants } from '../../constants';

export class RequestLogin extends Request {

    constructor(params: object) {
        let url = '/auth/v1/token';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        params = {
            ...params,
            client_key: Constants.CLIENT_KEY,
            client_secret: Constants.CLIENT_SECRET
        };
        super(url, "POST", headers, params);
    }
}