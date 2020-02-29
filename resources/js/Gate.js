export default class Gate {

    constructor(user){
        this.user = user; 
    }

    // 1 = admin, 2 = Author, 3 = User
    isAdmin(){
        return this.user.type == 1;
    }
    isAuthor(){
        return this.user.type == 2;
    }

    isUser(){
        return this.user.type == 3;
    }


    
}