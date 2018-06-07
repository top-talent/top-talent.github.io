const compareEntries = (a, b) =>
  a.start === b.start ? (b.end === a.end ? a.name.localeCompare(b.name) : b.end - a.end) : a.start - b.start;

export function greedyStrategy(entries) {
  const depths = new Array(20);

  entries = entries.sort(compareEntries);

  let maxDepth = 0;

  for (const entry of entries) {
    const { start, end } = entry;

    let depth = 0;
    let lastEntry;

    while (true) {
      lastEntry = depths[depth];

      if (lastEntry != null) {
        if (start < lastEntry.end && lastEntry.start <= end) {
          depth++;
          maxDepth = Math.max(maxDepth, depth);
          continue;
        }
      }

      entry.depth = depth;

      depths[depth] = entry;

      break;
    }
  }

  return { entries, maxDepth };
}