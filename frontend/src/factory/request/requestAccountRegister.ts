import { Request } from './request';

export class RequestAccountRegister extends Request {

    constructor(params: object) {
        let url = '/api/v1/account';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        super(url, "POST", headers, params);
    }
}