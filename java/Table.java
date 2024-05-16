import java.util.ArrayList;

public class Table{
    //Un table permet de représenter une table de base de données avec les actions que nous pouvons effectuer dedans
    private String nom; // nom de la table
    private int nbColonnes; //nombre de colonnes
    private ArrayList <String> nomsColonnes; //liste des noms de colonnes
    private boolean action; // est-ce que l'action sur la table a pu être effectuer ?
    private ArrayList<Donnees> donnees; //Liste de l'ensemble des données de notre table

    public Table (String nom, int nbColonnes, ArrayList <String> nomsColonnes){
        this.nom=nom;
        this.nbColonnes=nbColonnes;
        this.nomsColonnes=nomsColonnes;
        this.action=false;
        donnees=new ArrayList<Donnees>();
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

    public void ajouterDonnees(Donnees info){
        this.donnees.add(info);
    }

    public void modifierDonnee (String valeur_initial, String valeur_final, int idxColonne){
        if(this.donnees.size()==0){
            System.err.println("Aucune information de rentré dans le tableau");
        }else{
            for (Donnees info : this.donnees){
                if(info.getContenu().get(idxColonne)==valeur_initial){
                    info.getContenu().set(idxColonne, valeur_final);
                }
            }

        }   
    }

    public void supprimerDonnee(ArrayList<Integer> valeurs){
        
    }
}