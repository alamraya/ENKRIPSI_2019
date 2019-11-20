Module Module1
    Sub Main()
        Console.WriteLine("Algoritma Spread Spectrum")

        Console.WriteLine("Masukkan kalimat yang akan dienkrip: ")
        Dim input As String = Console.ReadLine
        Console.WriteLine("")

        Console.WriteLine("Masukkan kata kunci enkripsi: ")
        Dim kataKunci As String = Console.ReadLine
        Console.WriteLine("")

        Dim ss As New SpreadSpectrum()

        Dim hasilEnkripsi As String = ss.enkripsi(input, kataKunci)
        Console.WriteLine("Hasil enkripsi kalimat input adalah: " & vbCrLf & hasilEnkripsi & vbCrLf)

        Dim hasilDekripsi As String = ss.dekripsi(hasilEnkripsi, kataKunci)
        Console.WriteLine("Hasil dekripsi dari kalimat terenkripsi adalah: " & vbCrLf & hasilDekripsi & vbCrLf)

        Console.ReadLine()
    End Sub
End Module

Public Class SpreadSpectrum
    Public Function enkripsi(ByVal teks As String, ByVal kataKunci As String) As String
        Try
            Dim pesanSkala4(teks.Length * 4 - 1) As String
            Dim idxPesanSkala4 As Integer = 0

            For i As Integer = 0 To teks.Length - 1
                Dim tmpTeksBinary As String = StringToBinary(teks.Substring(i, 1))

                pesanSkala4(idxPesanSkala4) = tmpTeksBinary.Substring(0, 1) & tmpTeksBinary.Substring(0, 1) & tmpTeksBinary.Substring(0, 1) & tmpTeksBinary.Substring(0, 1) &
                    tmpTeksBinary.Substring(1, 1) & tmpTeksBinary.Substring(1, 1) & tmpTeksBinary.Substring(1, 1) & tmpTeksBinary.Substring(1, 1)
                idxPesanSkala4 += 1

                pesanSkala4(idxPesanSkala4) = tmpTeksBinary.Substring(2, 1) & tmpTeksBinary.Substring(2, 1) & tmpTeksBinary.Substring(2, 1) & tmpTeksBinary.Substring(2, 1) &
                    tmpTeksBinary.Substring(3, 1) & tmpTeksBinary.Substring(3, 1) & tmpTeksBinary.Substring(3, 1) & tmpTeksBinary.Substring(3, 1)
                idxPesanSkala4 += 1

                pesanSkala4(idxPesanSkala4) = tmpTeksBinary.Substring(4, 1) & tmpTeksBinary.Substring(4, 1) & tmpTeksBinary.Substring(4, 1) & tmpTeksBinary.Substring(4, 1) &
                    tmpTeksBinary.Substring(5, 1) & tmpTeksBinary.Substring(5, 1) & tmpTeksBinary.Substring(5, 1) & tmpTeksBinary.Substring(5, 1)
                idxPesanSkala4 += 1

                pesanSkala4(idxPesanSkala4) = tmpTeksBinary.Substring(6, 1) & tmpTeksBinary.Substring(6, 1) & tmpTeksBinary.Substring(6, 1) & tmpTeksBinary.Substring(6, 1) &
                    tmpTeksBinary.Substring(7, 1) & tmpTeksBinary.Substring(7, 1) & tmpTeksBinary.Substring(7, 1) & tmpTeksBinary.Substring(7, 1)
                idxPesanSkala4 += 1
            Next

            Dim kataKunciBytes() As Byte = System.Text.ASCIIEncoding.ASCII.GetBytes(kataKunci)
            Dim pseudonoise As Byte = 0
            For i As Integer = 0 To kataKunciBytes.Length - 1
                If i = 0 Then
                    pseudonoise = kataKunciBytes(i)
                Else
                    pseudonoise = pseudonoise Xor kataKunciBytes(i)
                End If
            Next

            Dim daftarSeed(pesanSkala4.Length - 1) As Byte
            For i As Integer = 0 To daftarSeed.Length - 1
                If i = 0 Then
                    daftarSeed(i) = pseudonoise
                Else
                    daftarSeed(i) = (17 * daftarSeed(i - 1) + 7) Mod 84
                End If
            Next

            Dim hasilModulasi(pesanSkala4.Length - 1) As Byte
            For i As Integer = 0 To hasilModulasi.Length - 1
                Dim intPesanSkala4 As Integer = Convert.ToByte(pesanSkala4(i), 2)
                hasilModulasi(i) = intPesanSkala4 Xor daftarSeed(i)
            Next

            Return System.Text.Encoding.Default.GetString(hasilModulasi)
        Catch ex As Exception
            Throw ex
        End Try
    End Function

    Public Shared Function StringToBinary(ByVal teks As String) As String
        Dim hasil As String = ""
        For Each C As Char In teks
            hasil &= System.Convert.ToString(AscW(C), 2).PadLeft(8, "0")
        Next
        Return hasil
    End Function

    Public Function dekripsi(ByVal teks As String, ByVal kataKunci As String) As String
        Dim hasilDemodulasi = System.Text.Encoding.Default.GetBytes(teks)

        Dim kataKunciBytes() As Byte = System.Text.ASCIIEncoding.ASCII.GetBytes(kataKunci)
        Dim pseudonoise As Byte = 0
        For i As Integer = 0 To kataKunciBytes.Length - 1
            If i = 0 Then
                pseudonoise = kataKunciBytes(i)
            Else
                pseudonoise = pseudonoise Xor kataKunciBytes(i)
            End If
        Next i

        Dim daftarSeed(hasilDemodulasi.Length - 1) As Byte
        For i As Integer = 0 To daftarSeed.Length - 1
            If i = 0 Then
                daftarSeed(i) = pseudonoise
            Else
                daftarSeed(i) = (17 * daftarSeed(i - 1) + 7) Mod 84
            End If
        Next i

        Dim pesanSkala4(hasilDemodulasi.Length - 1) As Byte
        For i As Integer = 0 To pesanSkala4.Length - 1
            pesanSkala4(i) = hasilDemodulasi(i) Xor daftarSeed(i)
        Next i

        Dim bytePesan(pesanSkala4.Length / 4 - 1) As Byte
        Dim idxPesan As Integer = 0
        For i As Integer = 0 To pesanSkala4.Length - 1 Step 4

            Dim tmp As String = StringToBinary(ChrW(pesanSkala4(i)))
            Dim tmp2 As String = StringToBinary(ChrW(pesanSkala4(i + 1)))
            Dim tmp3 As String = StringToBinary(ChrW(pesanSkala4(i + 2)))
            Dim tmp4 As String = StringToBinary(ChrW(pesanSkala4(i + 3)))

            Dim tmpPesan As String = tmp.Substring(0, 1) + tmp.Substring(4, 1) +
                tmp2.Substring(0, 1) + tmp2.Substring(4, 1) +
                tmp3.Substring(0, 1) + tmp3.Substring(4, 1) +
                tmp4.Substring(0, 1) + tmp4.Substring(4, 1)

            bytePesan(idxPesan) = Convert.ToByte(tmpPesan, 2)
            idxPesan += 1
        Next i

        Return System.Text.Encoding.ASCII.GetString(bytePesan)
    End Function

    Public Shared Function BinaryToString(ByVal teks As String) As String
        Dim hasil As String = ""

        For i As Integer = 0 To teks.Length - 1 Step 8
            Dim tmpBinary As String = teks.Substring(i, 8)
            hasil += ChrW(Convert.ToByte(tmpBinary, 2))
        Next

        Return hasil
    End Function
End Class
