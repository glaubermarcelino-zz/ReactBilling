import { Request } from './request';

export class RequestCategoryTypeList extends Request {

    constructor(id: number) {
        let url = `/api/v1/category/${id}`;
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        super(url, "GET", headers, null);
    }

}