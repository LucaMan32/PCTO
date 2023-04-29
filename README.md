# PCTO
Progetto realizzato nel 2020, al fine di gestire i PCTO effettuati dagli studenti appartenenti ad una scuola.

Obiettivo: creazione di una piattaforma la quale permetta:
  login tramite email e password da parte degli utenti già registrati
  registrazione del nome, cognome, email, password per i nuovi utenti
  
  landing page che permette di effettuare il logout o di accedere a 4 diverse aree: studente, azienda, stage, corso sulla sicurezza
  Studente: permette di visualizzare i dati relativi a tutti gli studenti inseriti, fornita di form per la ricerca di uno specifico studente
  Azienda: permette di visualizzare i dati relativi a tutte le aziende inserite, fornita di form per la ricerca di una specifica azienda
  Stage: permette di visualizzare i dati relativi a tutti gli stage inseriti, fornita di form per la ricerca di uno specifico stage
  Corso sulla sicurezza: permette di visualizzare i dati relativi a tutti i corsi inseriti, fornita di form per la ricerca di un corso specifico 

Dettagli: 
  Login: controlli dei dati inseriti con il db per verificarne l'autenticità delle credenziali fornite, inoltre viene effettuato un controllo sul dominio della email,
         infatti a seconda del dominio utilizzato che può essere "@iismajorana.edu.it" o "@coordinatore.edu.it" si potrà accedere a diverse aree successivamente.
  Registrazione: controlli sulla sintassi dell'email e confronto delle password inserite per verificare che combacino e non ci siano stati errori.
  
  Studente: a seconda del dominio utilizzato si potranno aggiungere, modificare ed eliminare campi dalle tabelle
  Azienda: a seconda del dominio utilizzato si potranno aggiungere, modificare ed eliminare campi dalle tabelle
  Stage: a seconda del dominio utilizzato si potranno aggiungere, modificare ed eliminare campi dalle tabelle
  Corso sulla sicurezza: a seconda del dominio utilizzato si potranno aggiungere, modificare ed eliminare campi dalle tabelle
  
  Modifiche future:
    ottimizzazione del codice, esempio: 
        rimozione del codice commentato
        aggiunta di commenti
    miglioramento parte grafica
    ottimizzazione e aggiunta dei controlli relativi alle email e ad altri campi
    
    Note: in fase di Sign Up nella password la prima lettera deve essere minuscola seguita da una maiuscola, usare il . come carattere speciale e totale 8 caratteri
