import java.util.ArrayList;

public class Table{
    //Un table permet de représenter une table de base de données avec les actions que nous pouvons effectuer dedans
    private String nom; // nom de la table
    private int nbColonnes; //nombre de colonnes
    private ArrayList <String> nomsColonnes; //liste des noms de colonnes
    private boolean action; // est-ce que l'action sur la table a pu être effectuée ?
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

    public ArrayList <Donnees> getDonnees(){
        return this.donnees;
    }

    public boolean supprimerTable(){
        this.nom=null;
        this.nbColonnes=0;
        this.nomsColonnes=new ArrayList<String>();
        this.action=true;
        return this.action;
    }

    public void ajouterDonnees(Donnees info){
        //On part du principe que les données seront ajoutés une fois la table créée
        this.donnees.add(info);
    }

    public void modifierDonnee (String valeur_initial, String valeur_final, int idxColonne){
        //Une donnée modifié revient à changer en une valeur_final la valeur initial : on vérifie donc toutes nos données
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

    public void supprimerDonnee(String valeur, int idxColonne){
        //Lorsqu'une donnée est supprimer elle l'est entièrement : pas seulement un élément
        for (Donnees info : this.donnees){
            if(info.getContenu().get(idxColonne)==valeur){
                info.supprimerDonnee();
            }
        }
    }
}