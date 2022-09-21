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

// Check if array is empty. If so, return false.
// Define pointers that will each refer to an index. First value plus adjacent scout number.
// Define uniqueValues starting at 1, since there will always be at least one.
// Use a while loop to let the second pointer do some logic until the scout pointer reaches the end of the array.
// If the two pointers start at the same value, move the scout up one.
