// 3/3, ed
#include <bits/stdc++.h>
#pragma GCC optimize("Ofast")

int vec[100],
    x;

int
main(void)
{
  std::cin >> x;

  for (int i = 0; i < x; ++i)
    std::cin >> vec[i];
  std::sort(vec, vec + (x >> 1));
  for (int i = 0; i < x; ++i)
    std::cout << vec[i] << ' ';
}