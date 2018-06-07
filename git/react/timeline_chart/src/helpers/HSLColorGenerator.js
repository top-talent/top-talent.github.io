function hashCode(string) {
  if (!string) {
    return 0;
  }

  // Hash algorithm for substrings is described in "Über die Komplexität der Multiplikation in
  // eingeschränkten Branchingprogrammmodellen" by Woelfe.
  // http://opendatastructures.org/versions/edition-0.1d/ods-java/node33.html#SECTION00832000000000000000
  const p = ((1 << 30) * 4 - 5);  // prime: 2^32 - 5
  const z = 0x5033d967;           // 32 bits from random.org
  const z2 = 0x59d2f15d;          // random odd 32 bit number
  const length = string.length;

  let s = 0;
  let zi = 1;

  for (let i = 0; i < length; i++) {
    let xi = string.charCodeAt(i) * z2;
    s = (s + zi * xi) % p;
    zi = (zi * z) % p;
  }

  s = (s + zi * (p - 1)) % p;

  return Math.abs(s | 0);
}

export class HSLColorGenerator {
  constructor(hueSpace, satSpace, lightnessSpace, alphaSpace) {
    this._hueSpace = hueSpace || { min: 0, max: 360 };
    this._satSpace = satSpace || 67;
    this._lightnessSpace = lightnessSpace || 80;
    this._alphaSpace = alphaSpace || 1;
    this._colors = new Map();
  }

  setColorForID(id, color) {
    this._colors.set(id, color);
  }

  colorForID(id) {
    let color = this._colors.get(id);

    if (!color) {
      color = this._generateColorForID(id);
      this._colors.set(id, color);
    }

    return color;
  }

  _generateColorForID(id) {
    const hash = hashCode(id);
    const h = HSLColorGenerator._indexToValueInSpace(hash, this._hueSpace);
    const s = HSLColorGenerator._indexToValueInSpace(hash >> 8, this._satSpace);
    const l = HSLColorGenerator._indexToValueInSpace(hash >> 16, this._lightnessSpace);
    const a = HSLColorGenerator._indexToValueInSpace(hash >> 24, this._alphaSpace);
    return 'hsla(' + h + ', ' + s + '%, ' + l + '%, ' + a + ')';
  }

  static _indexToValueInSpace(index, space) {
    if (typeof space === 'number') {
      return space;
    }

    const count = space.count || space.max - space.min;

    index %= count;

    return space.min + Math.floor(index / (count - 1) * (space.max - space.min));
  }
}

export const Warm = new HSLColorGenerator(
  { min: 30, max: 55 },
  { min: 70, max: 100, count: 6 },
  50,
  0.7
);

export const Cool = new HSLColorGenerator(
  { min: 210, max: 300 },
  { min: 70, max: 100, count: 6 },
  70,
  0.7
);

export const Vibrant = new HSLColorGenerator(
  { min: 30, max: 330 },
  { min: 50, max: 80, count: 5 },
  { min: 80, max: 90, count: 3 }
);

export const Light = new HSLColorGenerator(
  { min: 30, max: 330 },
  { min: 50, max: 80, count: 3 },
  85
);

export const Green = new HSLColorGenerator(
  { min: 120, max: 200 },
  { min: 50, max: 80, count: 3 },
  50,
  0.8
);

export default HSLColorGenerator;
