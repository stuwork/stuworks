#include <cstdio>
#include <cstdlib>
#include <cstring>
#include <cmath>
#include <algorithm>
#include <iostream>
#include <string>

using namespace std;

int len, ch_len, ch[100000];
string s, c, k, st[1000];

int comp(string a){
	for (int i = 0; i < len; ++ i){
		if (a == st[i]) return i;
	}
	return -1;
}

void init(){
	string dig[10] = {"0", "1", "2", "3", "4", "5", "6", "7", "8", "9"};
	for (int i = 0; i <= 255; ++ i){
		if (i > 99) st[i] = dig[i / 100] + dig[i % 100 / 10] + dig[i % 10];
		else if (i > 9) st[i] = dig[i / 10] + dig[i % 10];
		else st[i] = dig[i];
	}
}

string comb(string a, string b){
	int b_len = b.length();
	string temp = a + "-";
	for (int i = 0; i < b_len; ++ i){
		if (b[i] == '-') break;
		temp += b[i];
	}
	return temp;
}

int main(){
	string ant[16] = {"39", "39", "126", "126", 
					"39", "39", "126", "126",
					"39", "39", "126", "126",
					"39", "39", "126", "126"};

	int size = 16;
	len = 256, ch_len = 0;
	string temp = ant[0];
	init();
	for (int i = 0; i < size; ++ i){
		if (i == size - 1){
			cout<<comp(temp)<<endl;
			ch[ch_len ++] = comp(temp);
			break;
		}
		s = temp; c = ant[i + 1];
		k = s + "-" + c;
		if (comp(k) == -1){
			st[len ++] = k;
			//cout<<k<<endl;
			cout<<comp(s)<<endl;
			ch[ch_len ++] = comp(s);
			temp = c;
		}else{
			temp = k;
		}
	}	
	int flag_k = ch[0], len = 256;
	string pri = st[flag_k];
	cout<<pri<<endl;
	for (int i = 1; i < ch_len; ++ i){
		flag_k = ch[i];
		s = pri;
		pri = st[flag_k];
		k = comb(s, st[flag_k]);	
		st[len ++] = k;
		cout<<pri<<endl;
	}

	return 0;
}
