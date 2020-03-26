/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Usage example:
 * alert(convertToRupiah(10000000)); -> "Rp. 10.000.000"
 */
function convertToRupiah(angka,simbol='Rp. ')
{
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0)
            rupiah += angkarev.substr(i, 3) + '.';
    return simbol + rupiah.split('', rupiah.length - 1).reverse().join('');
}

/**
 * Usage example:
 * alert(convertToAngka("Rp 10.000.123")); -> 10000123
 */
function convertToAngka(rupiah)
{
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}


