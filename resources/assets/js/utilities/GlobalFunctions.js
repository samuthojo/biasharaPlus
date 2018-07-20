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
  }
  
}
