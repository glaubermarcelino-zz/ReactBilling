import { Request } from './request';

export class RequestUserLogged extends Request {

    constructor() {
        let url = '/api/v1/user/logged';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        super(url, "GET", headers, null);
    }

}