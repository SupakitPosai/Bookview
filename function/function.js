
function editCart(id_book,type) {
    let val = ''
    if (type == 1) {
        val = 1;
    }else{
        val = -1;
    }
    window.location.href(`/bookview/function/fn_cart.php?id_book=${id_book}&edit=1&val=${val}`);
    console.log('object')
}
function addDays(days) {
    const copy = new Date();
    copy.setDate(copy.getDate() + days);
    
        var thday = new Array ('อาทิตย์','จันทร์',
        'อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
        var thmonth = new Array ('มกราคม','กุมภาพันธ์','มีนาคม',
        'เมษายน','พฤษภาคม','มิถุนายน', 'กรกฎาคม','สิงหาคม','กันยายน',
        'ตุลาคม','พฤศจิกายน','ธันวาคม');

        document.write( copy.getDate()+ ' ' + thmonth[copy.getMonth()]+ ' ' + (0+copy.getFullYear()+543));
    return copy;
   
}

        
