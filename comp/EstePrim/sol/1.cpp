// 5/5, ed
#include <bits/stdc++.h>
#pragma GCC optimize("Ofast")

static inline bool
estePrim(int x)
{
  if (x < 2)
    return 0;
  if (x == 2)
    return 1;
  if (!(x & 1))
    return 0;
  for (int i = 3; i <= (x >> 1); ++i)
    if (x % i == 0)
      return 0;
  return 1;
}

int
main(void)
{
  int x;
  std::cin >> x;
  if (estePrim(x))
    std::cout << "DA";
  else std::cout << "NU";
}