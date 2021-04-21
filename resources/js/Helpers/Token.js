class Token{
    isValid(token){
        const payload = this.payload;

        if(payload){
            return payload.iss = "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/register" ? true :false;
        }
        return false;
    }

    payload(token){
        const pauload = token.split('.')[1];
        return this.decode(pauload);
    }

    decode(pauload){
        return JSON.parse(atob(pauload));
    }
}

export default Token = new Token();
