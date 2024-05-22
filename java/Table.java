import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.sql.Connection;

public class Table{
    //Un table permet de représenter une table de base de données avec les actions que nous pouvons effectuer dedans
    private String nom; // nom de la table
    private int nbColonnes; //nombre de colonnes
    private ArrayList <String> nomsColonnes; //liste des noms de colonnes
    private boolean action; // est-ce que l'action sur la table a pu être effectuée ?
    private ArrayList<Donnees> donnees; //Liste de l'ensemble des données de notre table
    private Connection con; 

    public Table (String nom, int nbColonnes, ArrayList <String> nomsColonnes, Connection con){
        this.nom=nom;
        this.nbColonnes=nbColonnes;
        this.nomsColonnes=nomsColonnes;
        this.action=false;
        this.con=con;
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

    public void ajouterDonnees(Donnees donnee){
        //On part du principe que les données seront ajoutés une fois la table créée
        this.donnees.add(donnee);
        // ajout de la donnée dans la bdd
        try{
            // dans un premier temps, on vérifie que la donnée n'est pas déjà dans la bdd
            StringBuilder verif = new StringBuilder("SELECT COUNT(*) FROM proj631_"+this.getNom()+" WHERE ");
            // on ajoute chaque info de la donnée
            for(int i=0; i<this.getNbColonnes();i++){
                verif.append(this.getNomsColonnes().get(i)+"=" + '"'+donnee.getContenu().get(i)+'"');
                if(i<this.getNbColonnes()-1){
                    verif.append(" AND ");
                }
            }

            System.out.println("Requête vérif SQL  : "+verif);
            PreparedStatement requete_verif=con.prepareStatement(verif.toString());
            ResultSet res = requete_verif.executeQuery();
            res.next();
            int count = res.getInt(1);
            System.out.println("Il y a "+ count+ " donnée correspondant à celle rentrée");

            if (count==0){
                // si la donnée n'est pas déjà dans la base alors on peut l'ajouter
                // on construit la requête SQL
                StringBuilder sql= new StringBuilder("INSERT INTO proj631_"+this.getNom()+ " (");
                // il faut récupérer les colonnes de la table
                for(int i=0; i<this.getNbColonnes();i++){
                    sql.append(this.getNomsColonnes().get(i));
                    if(i<this.getNbColonnes()-1){
                        sql.append(", ");
                    }
                }
                sql.append(") VALUES (");
                // il faut récupérer les informations à insérer dans la table
                for(int i=0; i<this.getNbColonnes();i++){
                    // si la colonne correspond à l'auteur d'un livre : colonne id_auteur
                    if (this.getNomsColonnes().get(i)=="id_auteur"){
                        // on transforme le string correspondant à id_auteur en int
                        sql.append('"' + Integer.parseInt(donnee.getContenu().get(i))+'"');
                        System.out.println("id de l'auteur : "+Integer.parseInt(donnee.getContenu().get(i)));
                    }
                    else{
                        sql.append('"' + donnee.getContenu().get(i)+'"');
                    }
                    if(i<this.getNbColonnes()-1){
                        sql.append(", ");
                    }
                }
                
                sql.append(")");             

                System.out.println("requete sql : "+sql);
                PreparedStatement requete=con.prepareStatement(sql.toString());
                requete.executeUpdate();
                System.out.println("La donnée "+donnee.affichage_donnee()+" a été ajouté à la table "+this.getNom()+" dans la bdd");
            }
            else{
                System.out.println("La donnée "+donnee.affichage_donnee()+" est déjà dans la bdd");
            }
        }
        catch(SQLException e){
            e.printStackTrace();
        }
    }

    public void modifierDonnee (String valeur_initiale, String valeur_finale, int idxColonne){
        //Une donnée modifié revient à changer en une valeur_final la valeur initial : on vérifie donc toutes nos données
        if(this.donnees.size()==0){
            System.err.println("Aucune information de rentré dans le tableau");
        }else{
            for (Donnees donnee : this.donnees){
                if(donnee.getContenu().get(idxColonne)==valeur_initiale){
                    donnee.getContenu().set(idxColonne, valeur_finale);
                    // modification de la donnée dans la bdd
                    try{
                        // il faut le nom de la colonne a modifier
                        String colonne = this.getNomsColonnes().get(idxColonne);
                        // construction de la requête sql
                        String sql="UPDATE proj631_"+this.getNom()+ " SET "+colonne+" = '"+valeur_finale+"' WHERE "+colonne+" = '"+valeur_initiale+"' ;";
                        // exécution de la requête
                        System.out.println("requete sql : "+sql);
                        PreparedStatement requete=con.prepareStatement(sql);
                        requete.executeUpdate();
                        System.out.println("La valeur "+valeur_initiale+ "de la donnée "+donnee.affichage_donnee()+" a bien été modifiée par "+valeur_finale+" dans la bdd");

                    }
                    catch(SQLException e){
                        e.printStackTrace();
                    }   
                }
            }
        }   
    }

    public void supprimerDonnee(Donnees donnee){
        //Lorsqu'une donnée est supprimer elle l'est entièrement : pas seulement un élément
        this.donnees.remove(donnee);
        donnee.supprimerDonnee();
        try{
            // construction de la requête sql
            String sql="DELETE FROM `proj631`"+this.getNom()+"WHERE `"+this.getNomsColonnes().get(0)+"` = '"+donnee.get_first_content()+"'";
            System.out.println("requete sql : "+sql);
            PreparedStatement requete=con.prepareStatement(sql);
            requete.executeUpdate();
            System.out.println("La donnée a été supprimer de la base de donnée");
        }
        catch(SQLException e){
            e.printStackTrace();
        }
    }
}