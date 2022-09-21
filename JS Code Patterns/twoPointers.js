<script>
// Two pointer technique based solution to find if there is a pair in A[0..N-1] with a given sum.

function isPairSum(A, N, X)
{
 
    // represents first pointer
    let i = 0;
 
    // represents second pointer
    let j = N - 1;
 
    while (i < j) {
        // If we find a pair
        if (A[i] + A[j] == X)
            return true;
 
        // If sum of elements at current pointers is less, we move towards higher values by doing i++
        else if (A[i] + A[j] < X)
            i++;
 
        // If sum of elements at current pointers is more, we move towards lower values by doing j--
        else
            j--;
    }

    return false;
}
 
    // Array declaration
    let arr = [ 3, 5, 9, 2, 8, 10, 11 ];
     
    // Value to search for
    let val = 17;
     
    // Size of the array
    let arrSize =7;
     
    // Function call
    document.write(isPairSum(arr, arrSize, val));

   </script>