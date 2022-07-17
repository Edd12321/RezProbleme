#pragma GCC optimize("O2")
#pragma GCC target("avx,avx2,fma")
#include <fstream>
#include <iostream>
#include <istream>
#include <stack>
#include <string>
#include <vector>

extern "C" {
  #include <stdlib.h>
}

/***** MACRO BEGIN *****/
#define ll   long long
#define ever (;;)

#define $INIT_XY() { \
	y = stack.top(); \
	stack.pop();     \
	x = stack.top(); \
	stack.pop();     \
}
/***** MACRO END *****/

using std::cin;
using std::cout;
using std::exit;
using std::getline;
using std::ifstream;
using std::istream;
using std::noskipws;
//using std::stack;
using std::string;
using std::vector;

enum Where {
	NORTH, SOUTH, EAST, WEST
};
Where where = Where::EAST;

/** what to parse **/
vector<string> file;
ll oo, c_size;
/** stack machine **/
std::stack<ll> stack;

/** ip/pc **/
ll x_pos, y_pos;

/** string-mode **/
bool sm;

static void
move_ip(void)
{
	switch(where) {
	case NORTH:
		--y_pos;
		if (y_pos < 0)
			y_pos = oo;
		break;
	case SOUTH:
		++y_pos;
		if (y_pos > oo)
			y_pos = 0;
		break;
	case EAST:
		++x_pos;
		if (x_pos > c_size)
			x_pos = 0;
		break;
	case WEST:
		--x_pos;
		if (x_pos < 0)
			x_pos = c_size;
		break;
	}
}

static void
kmain(istream& in)
{
	string tmp;
	bool first_line = false;
	while (getline(in, tmp)) {
		file.emplace_back(tmp);
		if (!first_line) {
			if (tmp[0] == '#' && tmp[1] == '!') //remove UNIX hashbang
				file.pop_back();
			first_line = true;
		}
	}

	oo     = file.size()-1;

	/* elements to use in operations */
	int x, y;

	for ever {
		c_size = file[y_pos].length()-1;
		//cout << "X: " << x_pos << " Y: " << y_pos << ' ' << file[y_pos][x_pos] << '\n';
		cout.flush();
		
		if (sm) {
			if (file[y_pos][x_pos] == '"')
				sm = !sm;
			else
				stack.push(file[y_pos][x_pos]);
		} else if (file[y_pos][x_pos] >= '0' && file[y_pos][x_pos] <= '9') {
			/* digits 0-9 */
			stack.push(file[y_pos][x_pos]-'0');
		} else if (file[y_pos][x_pos] >= 'A' && file[y_pos][x_pos] <= 'F') {
			/* hexadecimal numbers A-F (10-15) */
			stack.push(file[y_pos][x_pos]-50);
		} else {
			switch(file[y_pos][x_pos]) {
			 /*********/
			 /** NOP **/
			 /*********/
			case ' ':
				break;
			 /****************/
			 /** TRAMPOLINE **/
			 /****************/
			case '#':
				move_ip();
				break;

			 /*********/
			 /** NOT **/
			 /*********/
			case '~':
				x = stack.top();
				stack.pop();
				stack.push(!x);
				break;

			 /***********/
			 /** CRASH **/
			 /***********/
			case '!':
				abort();

			 /*************************/
			 /** INSTRUCTION POINTER **/
			 /*************************/
			case '^': // N direction
				where = Where::NORTH;
				break;
			case 'v': // S direction
				where = Where::SOUTH;
				break;
			case '>': // E direction
				where = Where::EAST;
				break;
			case '<': // W direction
				where = Where::WEST;
				break;
			case '?':{// random direction 
				vector<Where> possible_directions = {
					Where::NORTH,
					Where::SOUTH,
					Where::EAST,
					Where::WEST
				};
				srand(time(NULL));
				where = possible_directions[rand()%4];
				break;
			}
			case 't': // teleport
				$INIT_XY();
				x_pos = x;
				y_pos = y;
				break;
			case '_': // < if true or > if false
				x = stack.top();
				stack.pop();
				if (x)
					where = Where::WEST;
				else
					where = Where::EAST;
				break;
			case '|': // ^ if true or v if false
				x = stack.top();
				stack.pop();
				if (x)
					where = Where::NORTH;
				else
					where = Where::SOUTH;
				break;
 
			 /************************/
			 /** ARITHMETIC OPCODES **/
			 /************************/
			case '+':
				$INIT_XY();
				stack.push(x+y);
				break;
			case '-':
				$INIT_XY();
				stack.push(x-y);
				break;
			case '*':
				$INIT_XY();
				stack.push(x*y);
				break;
			case '/':
				$INIT_XY();
				stack.push(x/y);
				break;
			case '%':
				$INIT_XY();
				stack.push(x%y);
				break;

			 /*************************/
			 /** INCREMENT/DECREMENT **/
			 /*************************/
			case 'i':
				x = stack.top();
				stack.pop();

				++x;
				stack.push(x);
				break;
			case 'd':
				x = stack.top();
				stack.pop();

				--x;
				stack.push(x);
				break;

			 /****************/
			 /** VALUE SWAP **/
			 /****************/
			case '\\':
				$INIT_XY();
				stack.push(y);
				stack.push(x);
				break;
			
			 /************************/
			 /** INTEGER COMPARISON **/
			 /************************/
			case ')': // greater-than
				$INIT_XY();
				stack.push(x>y);
				break;
			case '=': // equal to
				$INIT_XY();
				stack.push(x==y);
				break;
			case 'z':// different
				$INIT_XY();
				stack.push(x!=y);
				break;
			case '(': // less-than
				$INIT_XY()
				stack.push(x<y);
				break;
			
			 /******************/
			 /** INPUT/OUTPUT **/
			 /******************/
			case 'e': // emit (byte)
				cout << (char)stack.top(); 
				stack.pop();
				break;
			case '.':{// inp (byte)
				stack.push(cin.get());
				break;
			}
			case '$': // emit (integer)
				cout << stack.top();
				stack.pop();
				break;
			case '&':{// inp (integer)
				ll num;
				cin >> num;
				stack.push(num);
				break;
			}

			 /************************/
			 /** INSERT INSTRUCTION **/
			 /************************/
			case 'w':
				move_ip();
				file[y_pos][x_pos] = stack.top();
				stack.pop();
				break;

			 /************************************/
			 /** CONDITIONAL PCOUNTER DIRECTION **/
			 /************************************/
			case '[': // if the top element of the stack is 0, change the direction.
				if (!stack.top())
					where = Where::WEST;
				break;
			case ']':
				if (!stack.top())
					where = Where::EAST;
				break;
			case 'n':
				if (!stack.top())
					where = Where::NORTH;
				break;
			case 'u':
				if (!stack.top())
					where = Where::SOUTH;
				break;

			 /**********************/
			 /** STRING/PUSH MODE **/
			 /**********************/
			case '"':
				sm = !sm;
				break;
			 /************************/
			 /** STACK MANIPULATION **/
			 /************************/
			case 'p': // pop
				stack.pop();
				break;
			case 'r':{// reverse stack
				std::stack<ll> tmp_stak;
				while (!stack.empty()) {
					ll top = stack.top();
					stack.pop();
					tmp_stak.push(top);
				}
				stack = tmp_stak;
				break;
			}
			case ':': // duplicate top of stack
				stack.push(stack.top());
				break;
			case ';': // duplicate x y times
				$INIT_XY();
				stack.push(x);
				for (int i = 0; i < y; ++i)
					stack.push(x);
				break;
			
			 /*************************/
			 /** STACK ELEMENT COUNT **/
			 /*************************/
			case 's':
				stack.push(stack.size());
				break;

			 /**********/
			 /** HALT **/
			 /**********/
			case '@':
				exit(0);
			}
		}
		move_ip();
	}
}

int
main(int argc, char *argv[])
{
	if (argc < 2) {
		kmain(cin);
	} else {
		ifstream fin(argv[1]);
		kmain(fin);
	}
}
