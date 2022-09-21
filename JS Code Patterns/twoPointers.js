const uniqueValueCount = function (array) {   if (array.length < 1) {
    return false;
  }
  
  let pointerOne = 0;
  let pointerTwo = pointerOne + 1;
  let uniqueValues = 1;    while (pointerTwo < array.length) {   if (array[pointerOne] === array[pointerTwo]) {
     pointerTwo++;   }  else {
     pointerOne = pointerTwo;
     uniqueValues++;
   }  }
return uniqueValues;};
console.log(uniqueValueCount([2, 3, 4, 4]));