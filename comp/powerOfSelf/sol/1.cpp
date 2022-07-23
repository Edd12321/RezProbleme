// 6/6, edward_9x
#include <bits/stdc++.h>
using namespace std;

int
main(void)
{
  int x;
  cin >> x;

  int prod = 1;
  if (!x){
    cout << 1;
    return 0;
  }

  for (int i = 0; i < x; ++i)
    prod *= x;
  cout << prod;
}