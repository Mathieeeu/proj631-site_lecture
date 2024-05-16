import java.util.ArrayList;

public class Table{
    //Un table permet de représenter une table de base de données avec les actions que nous pouvons effectuer dedans
    private String nom; // nom de la table
    private int nbColonnes; //nombre de colonnes
    private ArrayList <String> nomsColonnes; //liste des noms de colonnes
    private boolean action; // est-ce que l'action sur la table a pu être effectuer ?

    public Table (String nom, int nbColonnes, ArrayList <String> nomsColonnes){
        this.nom=nom;
        this.nbColonnes=nbColonnes;
        this.nomsColonnes=nomsColonnes;
        this.action=false;
    }

    public String getNom(){
        return this.nom;
    }

    public int getNbColonnes(){
        return this.nbColonnes;
    }

    public ArrayList <String> getNomsColonnes(){
        return this.nomsColonnes;
    }

    public boolean supprimerTable(){
        this.nom=null;
        this.nbColonnes=0;
        this.nomsColonnes=new ArrayList<String>();
        this.action=true;
        return this.action;
    }
}