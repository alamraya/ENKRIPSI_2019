#include <iostream>
#include <conio.h>
#include <stdio.h>
#include <math.h>
#include <string.h>
#include <stdlib.h>
int a,b,q,j,goprim, m[100], e[100];
long double c[100], n;
char pesan[100];
int prima(int x);
void kuncienkrip();
void enkrip();
using namespace std;

int main()
{  int i;
                       goprim = 0;
                       while(goprim==0)
                       { cout<<"Masukkan bilangan prima p : ";
                       cin>>a;
                       goprim = prima(a);
                       if(goprim==0)
                       cout<<"Inputan bukan bilangan prima "<<endl;            }
                       goprim = 0;
                       while(goprim==0||a==b)
                       { cout<<"Masukkan bilangan prima q : ";
                           cin>>b;
                           goprim=prima(b);
                           if(goprim==0||a==b)
                           cout<<"Inputan salah "<<endl;           }
                       cout<<"\nMasukkan pesan yang ingin dienkripsi : ";
                       fflush(stdin);
                       cin>>pesan;
                       for (i=0; pesan[i]!=0;i++)
                       { m[i]=pesan[i];  }
                       n = a*b;
                       q = (a-1)*(b-1);
                       kuncienkrip();
                       cout<<"\nNilai e (kunci enkripsi) : ";
                       for (i=0;i<1;i++)
                       { cout<<e[i+1]<<"\t";    }
                       enkrip();
                       getch();   }
void faktor()
{                     int a, b, f, fktr[100];
                       b=0;
                       for(a=2;a<=f;a++)
                       {  if((f%a)==0)
                           {  fktr[b]=a;
                                       f/=a;
                                       a--;
                                       b++;                 }          }          }
int gcd(int r, int t)
{  int s, x;
                       if(t>r)
                       {             x=r;
                           r=t;
                           t=x;    }
                       s=r%t;
                       while (s!=0)
                       {             r=t;
                           t=s;
                           s=r%t;              }
                       return t;   }

int psy(int m)
{                     int i, pi;
                       pi=0;
                       for(i=0;i<m;i++)
                       {  if(gcd(m,i)==1)
                           pi++;    }
                       return pi;             }
int prima(int x)
{  int i;
                       j = sqrt(x);
                       for(i=2;i<=j;i++)
                       {  if(x%i==0)
                                       return 0;           }
                       return 1;  }
void kuncienkrip()
{  int k, i;
                       k = 0;
                       for (i=2;i<q;i++)
                       {  if((q%i)==0)
                           continue;
                           goprim=prima(i);
                           if(goprim==1 && i!=a && i!=b)
                           {  e[k]=i;
                                       if(goprim>0)
                                                   k++;
                                       if(k==99)
                                                   break;              }          }          }
void enkrip()
{  int l, key=e[1];
                       cout<<endl<<"\nCipherteks : ";
                       for(l=0;m[l]!=0;l++)
                       {             c[l]=fmod((pow(m[l],key)), n);
                                       cout<<c[l]<<" ";          }}
