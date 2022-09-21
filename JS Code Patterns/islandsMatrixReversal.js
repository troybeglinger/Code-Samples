// Given an m x n 2d grid map of '1's (land) and '0's (water), return the number of islands.
// First use a Breadth-first search or Depth-first search algorithm.
// Then, search the 2D array. If you see a 1, calldfs and add some island counters while checking position in the drid and changing each visited cell by 0.

const numIslands = (grid) => {
    const isIsland = (i, j) =>
      i >= 0 &&
      i < grid.length &&
      j >= 0 &&
      j < grid[i].length &&
      grid[i][j] === '1';
  
    const bfs = (i, j) => {
      const queue = [[i, j]];
  
      while (queue.length) {
        const [i, j] = queue.shift();
  
        grid[i][j] = '0';
  
        if (isIsland(i + 1, j)) queue.push([i + 1, j]);
        if (isIsland(i, j + 1)) queue.push([i, j + 1]);
        if (isIsland(i - 1, j)) queue.push([i - 1, j]);
        if (isIsland(i, j - 1)) queue.push([i, j - 1]);
      }
    };
  
    let counter = 0;
  
    for (let i = 0; i < grid.length; i += 1) {
      for (let j = 0; j < grid[i].length; j += 1) {
        if (grid[i][j] === '1') {
          counter += 1;
          bfs(i, j);
        }
      }
    }
  
    return counter;
  };