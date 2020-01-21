export class Request {

    private readonly _url: string;
    private readonly _method: string;
    private readonly _headers: any;
    private readonly _params: any;

    constructor(url: string, method: string, headers: any, params: any) {
        this._url = url;
        this._method = method;
        this._headers = headers;
        this._params = params;
    }

    public get url(): string {
        return this._url;
    }

    public get method(): string {
        return this._method;
    }

    public get headers(): any {
        return this._headers;
    }

    public get params(): any {
        return this._params;
    }
}
