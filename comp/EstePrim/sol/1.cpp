// 5/5, edward_9x
#include <bits/stdc++.h>
using namespace std;

bool
este_prim(int x)
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
  cin >> x;
  if (este_prim(x))
    cout << "DA";
  else
    cout << "NU";
}
