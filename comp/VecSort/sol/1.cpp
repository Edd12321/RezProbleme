// 3/3, edward_9x
#include <bits/stdc++.h>
using namespace std;

int
main(void)
{
  int n;
  cin >> n;  

  vector<int> n1;
  for (int i = 0; i < n; ++i) {
    int x;
    cin >> x;

    n1.emplace_back(x);
  }
  sort(n1.begin(), n1.begin()+n1.size()/2);
  for (int i = 0; i < n; ++i)
    cout << n1[i] << ' ';
}