#include "header.h"


int main()
{

    int sesuai;
    int kunci_angka[4];
    char kunci[4], pesan[100];
    char pesanEn[100], pesanDe[100];
    puts("====== Program Hill Cipher ======");
    sesuai:
    printf("Masukan Kunci : ");gets(kunci);
    nilaikunci(kunci, &kunci_angka, 4);
    sesuai=cek_kunci(kunci_angka);
    if(sesuai==1){
        puts("<<<Kunci Sesuai>>>");
    }
    else{
        puts("Kunci tidak sesuai, mohon diulang");
        goto sesuai;
    }
    printf("Masukan Pesan : ");gets(pesan);
    int pesanlen=strlen(pesan);
    int pesanlen1;
    int pesanToNum[pesanlen];
    puts("-----------------------------------------");
    printf("Kunci : ");cetak_pesan(kunci,4);
    printf("\nPesan : ");cetak_pesan(pesan,pesanlen);
    puts("\n-----------------------------------------\n");

    pesan[pesanlen]=pesan[pesanlen-1];
    pesanlen1=pesanlen+1;
    int MEnkripsi[500];
    int MDekripsi[500];
    int hasilXE[500];
    int hasilXD[500];

    nilaikunci(kunci,&kunci_angka,4);
    puts("-----------------------------------------");
    puts("Matriks dari Kunci");
    cetak_matrik(kunci_angka, 5);

    nilaikunci(pesan,&pesanToNum,pesanlen1);
    puts("-----------------------------------------");
    puts("Matriks dari Pesan");
    cetak_matrik(pesanToNum, pesanlen1);

    puts("-----------------------------------------");
    system("pause");

    puts("-----------------------------------------");
    puts("Matriks Enkripsi = kunci * pesan");
    Enkripsi(kunci_angka, pesanToNum, pesanlen1, &MEnkripsi,&hasilXE);
    cetak_matrik(hasilXE,pesanlen1);
    puts("");

    puts("-----------------------------------------");
    puts("Matriks Enkripsi");
    cetak_matrik(MEnkripsi,pesanlen1);

    nilaipesan(&pesanEn,MEnkripsi,pesanlen1);

    puts("-----------------------------------------");
    printf("Enkripsi Pesan : ");
    cetak_pesan(pesanEn, pesanlen1-1);
    puts("\n-----------------------------------------");
    system("pause");
    puts("-----------------------------------------");

    Dekripsi(MEnkripsi, kunci_angka, pesanlen1, &MDekripsi, &hasilXD);

    puts("-----------------------------------------");
    puts("Matriks Dekripsi = kunci invers * pesan\n");
    cetak_matrik(hasilXD, pesanlen1);

    puts("-----------------------------------------");
    puts("Matriks Dekripsi\n");
    cetak_matrik(MDekripsi, pesanlen1);
    puts("");

    puts("-----------------------------------------");
    printf("\Pesan Dekripsi : ");
    nilaipesan(&pesanDe,MDekripsi,pesanlen1);

    cetak_pesan(pesanDe, pesanlen);
    puts("");
    puts("-----------------------------------------");

    return 0;
}
