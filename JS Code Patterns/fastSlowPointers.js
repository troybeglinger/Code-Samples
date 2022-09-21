// Problem - Given a linked list, determine if it has a cycle in it.
// Solution - To represent a cycle in the given linked list, we use an integer pos which represents the position (0-indexed) in the linked list where tail connects to. If pos is -1, then there is no cycle in the linked list.
// Notes - If the fast pointer catch up with slow pointer, then it's a circular linked list. If the fast pointer get to the end, then it's not a circular linked list.

const hasCycle = (head) => {
    let fast = head;
    while (fast && fast.next) {
      head = head.next;
      fast = fast.next.next;
      if (head === fast) return true;
    }
    return false;
  };