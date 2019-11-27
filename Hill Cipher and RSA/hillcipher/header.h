#ifndef HEADER_H_INCLUDED
#define HEADER_H_INCLUDED

#include <stdio.h>
#include <stdlib.h>
#include "string.h"

//prototype fungsi

void nilaikunci(char huruf[], int angka[], int batas);
void nilaipesan(char huruf[], int angka[], int batas);
void cetak_matrik(int matrik[], int batas);
void cetak_pesan(char pesan[], int batas);
void Enkripsi(int kunci[], int pesan[], int stop, int MEnkripsi[], int hasilX[]);
void adjoin(int kunci[], int adjK[]);
void Dekripsi(int C[], int kunci[], int stop,int MDekripsi[], int hasilX[]);

#endif // HEADER_H_INCLUDED
