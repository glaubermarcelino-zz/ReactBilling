import { Request } from './request';

export class RequestAccountUserLogged extends Request {

    constructor() {
        let url = '/api/v1/account/user/all';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        super(url, "GET", headers, null);
    }

}