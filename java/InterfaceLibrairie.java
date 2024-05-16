import javax.swing.*;
import javax.swing.border.Border;

import java.awt.event.*;
import java.util.ArrayList;
import java.awt.*;

public class InterfaceLibrairie extends JFrame {
    final static int HAUTEUR = 600;
    final static int LARGEUR = 900;
    private ArrayList<Table> liste_tables;
    private Table table_selectionnee;
    private Donnees donnee_selectionnee;
    private JPanel affichage;
    private JPanel zone_ajout;
    private JPanel zone_modification;
    private JComboBox<String> choix_table;

    public InterfaceLibrairie(ArrayList<Table> liste_tables) {
        this.liste_tables=liste_tables;
        this.setSize(LARGEUR, HAUTEUR);
        this.setTitle("Gestion de la librairie");
        // on initialise la table selectionnée automatiquement à la première table de la liste
        this.table_selectionnee=liste_tables.get(0);

        // création du fond
        JPanel fond=new JPanel();
        Color couleur_fond=Color.decode("#fbf2c4");
        fond.setBackground(couleur_fond);
        this.getContentPane().add(fond, BorderLayout.CENTER);

        // création de la zone de selection de la table
        JPanel selection=new JPanel();
        Color couleur_selection=Color.decode("#e5c185");
        selection.setBackground(couleur_selection);

        JTextField texte=new JTextField("Selectionner la table ");
        texte.setPreferredSize(new Dimension(200, 30));
        texte.setBackground(couleur_selection);
        texte.setBorder(null);
        Color couleur_texte=Color.decode("#c7522a");
        texte.setForeground(couleur_texte);
        texte.setEditable(false);
        texte.setFocusable(false);
        selection.add(texte);

        String[] liste_choix=recuperer_tables(liste_tables);
        choix_table=new JComboBox<>(liste_choix);
        choix_table.setForeground(couleur_texte);

        selection.add(choix_table);
        fond.add(selection);

        // création de la zone de boutons d'action
        JPanel actions=new JPanel();
        Color fond_boutons=Color.decode("#74a892");
        Color couleur_boutons=Color.decode("#008585");
        actions.setBackground(fond_boutons);
        // AJOUTER UNE DONNEE
        JButton ajouter=new JButton("Ajouter");
        ajouter.setForeground(couleur_boutons);
        ajouter.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                System.out.println("Ajout d'une donnée en cours dans la table " + table_selectionnee.getNom() + ".");
                // création de la nouvelle donnée :
                zone_ajout=new JPanel();
                Color couleur_ajout=Color.decode("#74a892");
                zone_ajout.setBackground(couleur_ajout);

                // on récupère le nombre de colonnes de la table :
                ArrayList<String> nomsColonnes=table_selectionnee.getNomsColonnes();
                // on affiche autant de zone de texte qu'il y a de colonnes pour pouvoir rentrer la nouvelle donnée
                for (String nomColonne : nomsColonnes) {
                    JTextField zoneTexte=new JTextField(nomColonne);
                    zone_ajout.add(zoneTexte);
                }

                JButton valider=new JButton("Valider");
                valider.addActionListener(new ActionListener() {
                    @Override
                    public void actionPerformed(ActionEvent e) {
                        ArrayList<String> textes = new ArrayList<>();
                        boolean texteVide=false;
                        for (Component comp : zone_ajout.getComponents()) {
                            if (comp instanceof JTextField) {
                                JTextField textField=(JTextField) comp;
                                String texte=textField.getText();
                                if (texte.isEmpty()) {
                                    texteVide=true;
                                    System.out.println("Toutes les colonnes n'ont pas été remplies");
                                    break; // Sortir de la boucle dès qu'un texte est vide
                                }
                                textes.add(texte);
                            }
                        }
                        if (!texteVide) {
                            System.out.println("Toutes les colonnes ont été remplies");
                            Donnees nouvelle_donnee=new Donnees(table_selectionnee, textes);
                            System.out.println("Nouvelle donnée : " + nouvelle_donnee.affichage_donnee());
                            // on ajoute la donnée à la table selectionnée
                            table_selectionnee.ajouterDonnees(nouvelle_donnee);
                            suppression_zone_ajout();
                        } 
                    }
                });
                zone_ajout.add(valider);               
                fond.add(zone_ajout);
                mise_a_jour_affichage();
            }
        });
        

        //MODIFIER UNE DONNEE
        JButton modifier=new JButton("Modifier");
        modifier.setForeground(couleur_boutons);
        modifier.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                if (donnee_selectionnee==null){
                    System.out.println("Aucune donnée sélectionnée");
                }
                else{
                    System.out.println("Modification de la donnée "+donnee_selectionnee.affichage_donnee()+" en cours");
                    // affichage de la modification de la donnée
                    zone_modification=new JPanel();
                    zone_modification.setLayout(new BoxLayout(zone_modification, BoxLayout.Y_AXIS));
                    Color couleur_modification=Color.decode("#74a892");
                    zone_modification.setBackground(couleur_modification);

                    // affichage en 2 zones principales
                    // zone choix : boutons qui représentes les colonnes de la donnée
                    JPanel zone_choix=new JPanel();
                    zone_choix.setBackground(couleur_modification);
                    // zone entrée : modification de la donnée et validation
                    JPanel zone_entree=new JPanel();
                    zone_entree.setBackground(couleur_modification);

                    // on affiche toutes les colonnes de la table pour sélectionner celle qui doit être modifiée
                    for (String nomDonnee : donnee_selectionnee.getContenu()){
                        System.out.println("Dans la boucle");
                        JButton choix_colonne=new JButton("<html>"+nomDonnee+"</html>");
                        choix_colonne.setForeground(couleur_boutons);
                        // chaque bouton de choix est ajouté à la zone de choix
                        zone_choix.add(choix_colonne);
                        choix_colonne.addActionListener(new ActionListener(){
                            @Override
                            public void actionPerformed(ActionEvent e) {
                                // on affiche un JTextField pour permettre de modifier l'élément de la donnée
                                System.out.println("Une colonne a été sélectionnée");
                                JTextField modification=new JTextField(nomDonnee);
                                zone_entree.add(modification);
                                // on récupère l'indexe du nom de la colonne dans la table
                                int index=donnee_selectionnee.getContenu().indexOf(nomDonnee);
                                JButton valider=new JButton("Valider");
                                zone_entree.add(valider);
                                valider.addActionListener(new ActionListener() {
                                    @Override
                                    public void actionPerformed(ActionEvent e) {
                                        //on récupère le texte qui a été entré
                                        String donnee_modifiee=modification.getText();
                                        System.out.println("Modification de "+nomDonnee+" par "+donnee_modifiee+" en cours.");
                                        table_selectionnee.modifierDonnee(nomDonnee, donnee_modifiee, index);
                                        suppression_zone_modification();
                                        };
                                    });
                                    mise_a_jour_affichage(); 
                                };
                            });   
                        zone_modification.add(zone_choix);
                        zone_modification.add(zone_entree);                            
                    } 
                }
                fond.add(zone_modification);
                mise_a_jour_affichage(); 
            }
        });

        //SUPPRIMER UNE DONNEE
        JButton supprimer=new JButton("Supprimer");
        supprimer.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                // Supprimer la donnée sélectionnée
                System.out.println("Suppression de la donnée "+donnee_selectionnee.affichage_donnee()+" en cours");
                table_selectionnee.supprimerDonnee(donnee_selectionnee);
                // mise à jour de l'affichage
                mise_a_jour_affichage();
            }
        });
        supprimer.setForeground(couleur_boutons);
        actions.add(ajouter);
        actions.add(modifier);
        actions.add(supprimer);
        fond.add(actions);

        // création de la zone d'affichage des données
        affichage=new JPanel();
        affichage.setBackground(couleur_fond);
        affichage.setPreferredSize(new Dimension(700, 380));
        affichage.setLayout(new BoxLayout(affichage, BoxLayout.Y_AXIS));
        Color couleur_bordure=Color.decode("#c7522a");
        Border border=BorderFactory.createLineBorder(couleur_bordure, 5);
        affichage.setBorder(border);
        fond.add(affichage);

        ArrayList<Donnees> liste_donnees=this.table_selectionnee.getDonnees();
        for (Donnees donnee : liste_donnees) {
            JButton bouton_donnee=new JButton("<html>" + donnee.affichage_interface() + "</html>");
            bouton_donnee.setOpaque(false);
            bouton_donnee.setContentAreaFilled(false);
            bouton_donnee.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent e) {
                    // On récupère la donnée sélectionnee
                    donnee_selectionnee=donnee;
                    System.out.println("Donnée sélectionnée : " + donnee_selectionnee.affichage_donnee());
                }
            });
            affichage.add(bouton_donnee);
        }

        choix_table.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                // Récupérer l'option sélectionnée
                String selection_table=(String) choix_table.getSelectedItem();
                System.out.println("Table sélectionnée : " + selection_table);
                for (Table t : liste_tables) {
                    if (t.getNom().equals(selection_table)) {
                        table_selectionnee = t;
                        mise_a_jour_affichage();
                    }
                }
            }
        });
    }

    private String[] recuperer_tables(ArrayList<Table> liste_tables) {
        String[] res=new String[liste_tables.size()];
        for (int i=0; i<liste_tables.size(); i++) {
            res[i]=liste_tables.get(i).getNom();
        }
        return res;
    }

    private void mise_a_jour_affichage() {
        System.out.println("Mise à jour de l'affichage des données");
        // partie affichage des données
        ArrayList<Donnees> liste_donnees = this.table_selectionnee.getDonnees();
        affichage.removeAll();
        for (Donnees donnee : liste_donnees) {
            JButton bouton_donnee=new JButton("<html>"+donnee.affichage_interface()+"</html>");
            bouton_donnee.setOpaque(false);
            bouton_donnee.setContentAreaFilled(false);
            bouton_donnee.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent e) {
                    // On récupère la donnée sélectionnee
                    donnee_selectionnee=donnee;
                    System.out.println("Donnée sélectionnée : " + donnee_selectionnee.affichage_donnee());
                }
            });            
            affichage.add(bouton_donnee);
        }
        // mise à jour de l'affichage des données
        affichage.revalidate();
        affichage.repaint();
    }

    private void suppression_zone_modification(){
        System.out.println("Mise à jour de l'interface en cours");
        // partie affichage des données
        mise_a_jour_affichage();

        zone_modification.removeAll();
        Color couleur_fond=Color.decode("#fbf2c4");
        zone_modification.setBackground(couleur_fond);
        zone_modification.revalidate();
        zone_modification.repaint();
    }

    private void suppression_zone_ajout(){
        System.out.println("Mise à jour de l'interface en cours");
        // partie affichage des données
        mise_a_jour_affichage();

        // partie pour la zone d'ajout d'une donnée
        //mise à jour de l'affichage pour masquer la zone d'ajout d'une donnée
        zone_ajout.removeAll();
        Color couleur_fond=Color.decode("#fbf2c4");
        zone_ajout.setBackground(couleur_fond);
        zone_ajout.revalidate();
        zone_ajout.repaint();
    }
}