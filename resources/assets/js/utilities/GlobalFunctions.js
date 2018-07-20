export default {

  getReadableMonth(int) {

    switch(parseInt(int)) {

      case 1: return 'January'

      case 2: return 'February'

      case 3: return 'March'

      case 4: return 'April'

      case 5: return 'May'

      case 6: return 'June'

      case 7: return 'July'

      case 8: return 'August'

      case 9: return 'September'

      case 10: return 'October'

      case 11: return 'November'

      case 12: return 'December'
    }

  },

  getShortDate(date) {

    if(!date) return ''

    date = date.toString()

    if(date.indexOf('-') != -1) {
      let isoDate = date.split(' ')[0]
      let year = isoDate.split('-')[0]
      let month = isoDate.split('-')[1]

      return globals.getReadableMonth(month) + " " + year
    }

    return date
  },

  getIndex(arrayOfObjects, comparisonObject) {

    return arrayOfObjects.findIndex(object => object.id == comparisonObject.id);

  },
  
  getDateOfBirth(date) {

     if(!date) return ''

     date = date.toString()

     if(date.indexOf('-') != -1) {
       let isoDate = date.split(' ')[0]
       let year = isoDate.split('-')[0]
       let month = isoDate.split('-')[1]
       let day = isoDate.split('-')[2]

       return day + " " + globals.getReadableMonth(month) + " " + year
     }

     return date

  },

  capitalizeEveryWord(str) {//Capitalizes first letter of every word
    str = str.trim();
    if(str.length == 0) return '';
    
    let strArray = str.split(' ');
    for(let index = 0; index < strArray.length; index++) {
      strArray.splice(index, 1, _.capitalize(strArray[index]));
    }
    return strArray.join(' ');
  },
  
  getMySqlDate(date) {
    
    date = date.toString()

    date = date.trim()
    
    if(date.length == 0) return ''

    if(date.indexOf('-') != -1) {
      let isoDate = date.split(' ')[0]
      let day = isoDate.split('-')[0]
      let month = isoDate.split('-')[1]
      let year = isoDate.split('-')[2]

      return year + "-" + month + "-" + day
    }

    return date
  },
  
  numberFormat(number, decimals, dec_point, thousands_sep)
  {
    // http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_number_format/
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec)
        {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3)
    {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec)
    {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
  
}
