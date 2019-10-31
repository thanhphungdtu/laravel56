
/*$(document).ready(function() {
    $('#message').val({
        responsive: true
    });
});*/
$("div.alert").delay(3000).slideUp();//hiên thị thông báo 3 dây


//ham kiem tra xoa
function xacnhanxoa(msg) {
    if (window.confirm(msg)){//thong bao hien yes hay no
        return true;//thuc hien cong viec do
    }
    return false;
}