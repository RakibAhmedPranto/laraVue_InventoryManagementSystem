class Notification{

    success(){
        new Noty({
            type:'success',
            layout: 'topRight',
            text: 'Complited Successfully',
            timeout: 1000,
        }).show();
    }

    alert(){
        new Noty({
            type:'alert',
            layout: 'topRight',
            text: 'Are You Sure?',
            timeout: 1000,
        }).show();
    }

    error(){
        new Noty({
            type:'alert',
            layout: 'topRight',
            text: 'Somethig Is Wrong!',
            timeout: 1000,
        }).show();
    }

    warning(){
        new Noty({
            type:'warning',
            layout: 'topRight',
            text: 'Opps Wrong!',
            timeout: 1000,
        }).show();
    }

    image_validation(){
        new Noty({
            type:'error',
            layout: 'topRight',
            text: 'Upload Image Less Than 1MB',
            timeout: 1000,
        }).show();
    }
}

export default Notification = new Notification();
