import java.util.ArrayList;

public class Table{
    private String nom;
    private int nbColonnes;
    private ArrayList <String> nomsColonnes;
    private boolean action;

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

    public void supprimerTable(){

    }
}