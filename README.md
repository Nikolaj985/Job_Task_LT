# Job_Task_LT
Aprašymas Klientas paėmė iš banko paskolą: 10000 EUR su 7% metinėmis palūkanomis. Paskola turi būti grąžinta per 26 įmokas: nuo 2016-11-15 iki 2018-12-15. Paskolos grąžinimo grafikas (ammortization schedule) yra sudaromas anuitetiniu (annuity) metodu. Tai reiškia, kad kas mėnesį kliento mokama suma (pagrindinė suma + palūkanos) nesikeičia. Tokio grafiko pavyzdį galite matyti Task_example.xlsx faile. Pirmajame stulpelyje matomas įmokos numeris, antrajame - kada klientas turi sumokėti įmoką. Likusiuose - tos dienos įmokos detalizacija.  

Užduotis (50% bendro balo): Klientas 2017-04-15 paėmė paskolą 5000 EUR su 12% metinių palūkanų, kuri turi būti grąžinta per 24 įmokas. 
1. Išsiaiškinti kaip generuojamas anuitetinis paskolos grąžinimo grafikas. Algoritmas/formulė nėra sudėtinga, ją nesunkiai rasite internete. 
2. Sugeneruoti grafiką su duotais parametrais. 
3. Pavaizduoti grafiką panašiu formatu kaip pavyzdiniame faile (turi būti visi tie patys stulpeliai). Failas turi būti paruoštas .csv formatu.  

Papildomos užduotys: 
1. (30% bendro balo) 2017-09-02 bankas sumažino palūkanų normą nuo 12% iki 9%. 
  1.1. Sugeneruoti dar vieną grafiką, kuriame palūkanų norma iki 2017-09-01 yra 12%, o nuo 2017-09-02 pasikeičia į 9%. 
2. (20% bendro balo) Programa leidžianti įvesti parametrus ir pagal juos sugeneruojanti amortizacijos grafiką. 
  2.1. Įvedama pradžios data, pradinė suma, palūkanų norma, įmokų skaičius. 
  2.2. Output - amortizacijos grafikas .csv formatu.  
  
Reikalavimai: 

  * Programavimo kalba - pasirinktinai. 
  * Bus kreipiamas dėmesys į tvarkingą kodo struktūrą. Kodas turi būti aiškus, tvarkingas ir atitikti kodo taisykles. 
  * Output - vienas arba du sugeneruoti "human-readable" grafikai .csv formatu. 
  * Output'e turi būti visi tie patys stulpeliai kaip pavyzdiniame faile. 
  * Skaičių tikslumas output'e - lygiai du simboliai po kablelio. Tai sukelia tam tikrų problemų, atkreipkite dėmesį.
