<?php

namespace CyberLagg;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class CyberLaggCommand extends Command implements PluginIdentifiableCommand {

  public $plugin;

  public function __construct(Loader $plugin) {
    parent::__construct("cyberlagg", "§aMenghapus lagg!", "/cyberlagg <check/clear/killmobs/clearall>", ["lagg"]);
    $this->setPermission("cyberlagg.command.clearlagg");
    $this->plugin = $plugin;
  }

  public function getPlugin() {
    return $this->plugin;
  }

  public function execute(CommandSender $sender, $alias, array $args) {
    if(!$this->testPermission($sender)) {
      return false;
    }
    if(isset($args[0])) {
      switch($args[0]) {
        case "clear":
         $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg§4] §aRemoved " . $this->getPlugin()->removeEntities() . " §fentities.");
          return true;
        case "check":
        case "count":
          $c = $this->getPlugin()->getEntityCount();
          $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg§4] §cFounded " . $c[0] . " pemain, " . $c[1] . " mobs, and " . $c[2] . " entities.");
          return true;
        case "reload":
          // TODO
          return true;
        case "killmobs":
          $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg§4] §aRemoved " . $this->getPlugin()->removeMobs() . " §emobs");
          return true;
        case "clearall":
         $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg] §aRemoved " . ($d = $this->getPlugin()->removeMobs()) . " §emobs" . ($d == 1 ? "" : "s") . " §band " . ($d = $this->getPlugin()->removeEntities()) . " §fentities" . ($d == 1 ? "y" : "ies") . ".");
          return true;
        case "area":
          // TODO
          return true;
        case "unloadchunks":
          // TODO
          return true;
        case "chunk":
          // TODO
          return true;
        case "tpchunk":
          // TODO
          return true;
        default:
          return false;
      }
    }
    return false;
  }

}