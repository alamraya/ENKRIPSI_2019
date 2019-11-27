#include "header.h"
void nilaikunci(char huruf[], int angka[], int batas){
    int i,j;
    char karakter[27]=" abcdefghijklmnopqrstuvwxyz";
    for(i=0;i<batas;i++){
        for(j=0;j<27;j++){
            if(huruf[i]==karakter[j]){
                angka[i]=j;
            }
        }
    }
}

void nilaipesan(char huruf[], int angka[], int batas){
    int i,j;
    char karakter[27]=" abcdefghijklmnopqrstuvwxyz";
    i=0;
    while(i<batas){
        for(j=0;j<27;j++){
            if(angka[i]==j){
                huruf[i]=karakter[j];
            }
        }
        i++;
    }
}
void cetak_matrik(int matrik[], int batas){
    int i,j;
    for(i=0;i<2;i++){
        for(j=0;j<batas-1;j++){
            if(i==0 && j%2==0){
                printf("%d\t",matrik[j]);
            }
            else if(i==1 && j%2!=0){
                printf("%d\t", matrik[j]);
            }
        }
        puts("");
    }
}

void cetak_pesan(char pesan[], int batas){
    int i=0;
    while(i<batas){
        printf("%c",pesan[i]);
        i++;
    }
}

//motubablog.blogspot.com

void Enkripsi(int kunci[], int pesan[], int stop, int MEnkripsi[], int hasilX[]){
    int i,j;
    hasilX[stop];
    int hasilMod[stop];
    j=0;
    for(i=0;i<stop;i+=2){
        hasilX[j]=((kunci[0]*pesan[i])+(kunci[2]*pesan[i+1]));
        hasilX[j+1]=((kunci[1]*pesan[i])+(kunci[3]*pesan[i+1]));
        j+=2;
    }
    for(i=0;i<stop;i++){
        hasilMod[i]=hasilX[i]%27;
        MEnkripsi[i]=hasilMod[i];
    }
}
int determinan_kunci(int kunci[]){
    return (kunci[0]*kunci[3])-(kunci[1]*kunci[2]);
}
void adjoin(int kunci[], int adjK[]){
    int tamp,i;
    tamp=kunci[3];
    kunci[3]=kunci[0];
    kunci[0]=tamp;
    kunci[1]*=-1;
    kunci[2]*=-1;
    for(i=0;i<4;i++){
        adjK[i]=kunci[i];
    }
}

int rumus_Z(int data){
    int i,j;
    for (i=1;i<27;i++){
        for (j=1;j<27;j++){
            if ((i*j)%27==1){
               if(i==data){
                   return j;
               }
            }
        }
    }
    return 0;
}
int modulo(int angka){
    int hasil;
    int a=angka;
    int b;
    if(angka<0 && angka>=-27){
        hasil=angka+27;
    }
    else if(angka<-27){
        while(angka<0){;
            angka+=27;
        }
        hasil=angka;
    }
    else{
        hasil=angka%27;
    }
    return hasil;
}
void Dekripsi(int C[], int kunci[], int stop,int MDekripsi[], int hasilX[]){
    int Z,i,j;
    int Zinvs;
    int adjK[4],Kinvs[4],Kmod[4];
    hasilX[stop];
    Z=modulo(determinan_kunci(kunci));
    printf("Z = %d\n",Z);
    Zinvs=rumus_Z(Z);
    printf("Z inves %d\n",Zinvs);
    adjoin(kunci,&adjK);
    for(i=0;i<4;i++){
        Kinvs[i]=Zinvs*adjK[i];
        Kmod[i]=modulo(Kinvs[i]);
    }
    j=0;
    for(i=0;i<stop;i+=2){
        hasilX[j]=((Kmod[0]*C[i])+(Kmod[2]*C[i+1]));
        hasilX[j+1]=((Kmod[1]*C[i])+(Kmod[3]*C[i+1]));
        j+=2;
    }
    for(i=0;i<stop;i++){
        MDekripsi[i]=modulo(hasilX[i]);
    }

}
int cek_kunci(int kunci[]){
    int Z,Zinvs;
    Z=modulo(determinan_kunci(kunci));
    Zinvs=rumus_Z(Z);
    if(Zinvs==0){
        return 0;
    }
    else{
        return 1;
    }
}

