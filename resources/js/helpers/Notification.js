class Notification {

    insert(){
        new Noty({
            type: 'success',
            text: 'Inserted successfully!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }

    update(){
        new Noty({
            type: 'success',
            text: 'Updated successfully!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }

    image_validation(){
        new Noty({
            type: 'error',
            text: 'Image size should be less then 2MB!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }


    error(){
        new Noty({
            type: 'error',
            text: 'ERROR!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }

    paySalary(){
        new Noty({
            type: 'success',
            text: 'Salary paid successfully!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }

    alreadyPaid(){
        new Noty({
            type: 'error',
            text: 'Salary already paid!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }

    add_to_cart(){
        new Noty({
            type: 'success',
            text: 'Product added to cart!',
            layout: 'topRight',
            timeout: 3000
            }).show();
    }

    remove_cart(){
        new Noty({
            type: 'success',
            text: 'Product removed form cart!',
            layout: 'topRight',
            timeout: 3000
            }).show();

    }

    order_done(){
        new Noty({
            type: 'success',
            text: 'Order submited successfully!',
            layout: 'topRight',
            timeout: 3000
            }).show();

    }


    
}
    
export default Notification = new Notification();
